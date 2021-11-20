<?php

namespace App\Http\Controllers;

use App\Models\UploadCounter;

class UploadCounterController extends Controller
{
    public function update()
    {
        $upl = UploadCounter::all()->take(1);

        if (count($upl) == 1) {
            $res = $upl[0];
            $res->downloads++;

            $res->save();
        }
    }
}
