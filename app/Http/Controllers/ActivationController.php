<?php

namespace App\Http\Controllers;

use App\Models\Activation;
use App\Models\KodeChecker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivationController extends Controller
{
    public function checkActivation($key, bool $updateStatistics = true): bool
    {
        $key = trim($key);

        if (empty($key)) {
            return 0;
        }

        if ($updateStatistics) {
            KodeChecker::create(['key' => $key]);
        }

        $isActivated = Activation::where(['key' => $key, 'is_payed' => '1'])->count();

        return $isActivated > 0;
    }

    public function successCallback(Request $request) {
        $result = array('payType' => 'unknown');
        $message = '';
        $isPayed = 0;
        $payResponse = false;
        $privateKey = env('LIQ_PAY_PRIVATE_KEY');
        $postData = $request->post('data');

        $sign = base64_encode( sha1($privateKey .$postData .$privateKey, 1 ));

        if ($sign != $request->post('signature')) {
            return 'Не верная подпись';
        }

        $data = json_decode(base64_decode($postData), true);
        $result['payData'] = base64_decode($postData);
        $payResponse = json_decode($result['payData'], true);

        switch($data['status']) {
            case 'error':
                $message = 'Неуспешный платеж. Некорректно заполнены данные';
                break;
            case 'failure':
                $message = 'Неуспешный платеж';
                break;
            case 'reversed':
                $message = 'Платеж возвращен';
                break;
            case 'sandbox':
                $message = 'Тестовый платеж';
                $isPayed = 1;
                break;
            case 'subscribed':
                $message = 'Подписка успешно оформлена';
                $isPayed = 1;
                break;
            case 'success':
                $message = 'Успешный платеж';
                $isPayed = 1;
                break;
            case 'unsubscribed':
                $message = 'Подписка успешно деактивирована';
                $isPayed = 1;
                break;
        }

        if ($payResponse !== false) {
            $order = json_decode($payResponse['order_id'], true);

            if ($this->checkActivation($order['key'])) {
                return view('old.activation_success');
            } else {
                $ac = new Activation();
                $ac->response = $result['payData'];
                $ac->message = $message;
                $ac->is_payed = $isPayed;

                $ac->amount = $payResponse['amount'];
                $ac->currency = $payResponse['currency'];
                $ac->payment_id = $payResponse['payment_id'];
                $ac->order_id = $payResponse['order_id'];

                $ac->key = $order['key'];

                $ac->save();

                return view('old.activation_success');
            }
        }

        return 'Что-то пошло не так';
    }

    public function showPayButton($key, $email = '', $pass = '')
    {
        $orderInfo = array(
            'key' => $key,
            'dt' => date("Y.m.d H:i:s"),
            'email' => $email,
            'pass' => $pass
        );

        $amount = env('LIQ_PAY_PAY_AMOUNT'); //рублей
        $liqPay = new \LiqPay(env('LIQ_PAY_PUBLIC_KEY'), env('LIQ_PAY_PRIVATE_KEY'));

        $html = $liqPay->cnb_form(array(
            'action'         => 'pay',
            'amount'         => $amount,
            'currency'       => 'RUB', //USD, EUR, RUB, UAH
            'description'    => 'Активация ключа: '.$key,
            'order_id'       => json_encode($orderInfo),
            'version'        => '3',
            'result_url' => env('LIQ_PAY_RESULT_URL'), // передается через редирект
            'server_url' => env('LIQ_PAY_SERVER_URL'), // передается через курл
            'sandbox' => env('LIQ_PAY_SANDBOX')
        ));

       return view('old.activate', ['button' => $html, 'key' => $key, 'amount' => $amount]);
    }
}
