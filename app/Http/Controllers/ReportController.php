<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        abort_if(!auth()->check(), 404);
        abort_if(auth()->user()->email != env('CREATOR_EMAIL', ''), 401);

        $downloads = DB::table('upload_counters')
            ->select('downloads')->first();

        $keyChecks = DB::table('kode_checkers')
            ->select(['key'
                , DB::raw('count(1) as cnt')
                , DB::raw("DATE_FORMAT(MAX(updated_at), '%d.%m.%Y %H:%i') AS dt")
                , DB::raw("IF(DATE(MAX(updated_at)) = CURDATE(), 1, 0) as is_today")
                , DB::raw("MAX(updated_at) AS sort_dt")
            ])
            ->groupBy('key')
            ->orderBy('sort_dt', 'DESC')
            ->orderBy('cnt', 'DESC')
            // ->limit(200)
            ->get();

        $moreThanOne = 0;

        $activationController = new ActivationController();

        foreach($keyChecks as $i => $row) {
            if ($i > 100) {
                break;
            }

            if ($row->cnt > 1) {
                $moreThanOne++;
            }

            $keyChecks[$i]->isPayed = $activationController->checkActivation($row->key, false);
        }

        return view('old.report', [
            'downloads' => $downloads->downloads ?? 0,
            'keys' => $keyChecks,
            'keysCount' => count($keyChecks),
            'moreThanOneRun' => $moreThanOne
        ]);
    }
}
