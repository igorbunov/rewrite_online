<?php

namespace App\Http\Controllers;

use App\Models\UploadCounter;

class UploadCounterController extends Controller
{
    public function update()
    {
        $uploads = UploadCounter::first();

        if (empty($uploads)) {
            UploadCounter::create(['downloads' => 1]);
        } else {
            $uploads->downloads++;
            $uploads->save();
        }
    }
}
