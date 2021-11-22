<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\SupportNotification;

class SupportController extends Controller
{
    public function index() {
        return view('support.index');
    }

    public function send(Request $request)
    {
        abort_if(!auth()->check(), 401);

        $adminUser = User::getAdminUser();

        if (empty($adminUser)) {
            return redirect()->route('support.index')->withStatus('Не найден админ');
        }

        $message = $request->post('message', '');

        if (empty($message)) {
            return redirect()->route('support.index')->withStatus('Пустое сообщение');
        }

        $adminUser->notify(new SupportNotification(auth()->user(), $message));

        return redirect()->route('support.index')->withStatus('Сообщение успешно отправлено!');
    }
}
