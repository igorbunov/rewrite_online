<?php

namespace App\Http\Controllers;

use App\Models\Synonim;
use Illuminate\Http\Request;

class SynonimController extends Controller
{
    public function find(Request $request)
    {
        $synonim = trim($request->post('word', ''));

        abort_if(empty($synonim), 404);

        $result = Synonim::where('name', $synonim)->first();

        if (empty($result)) {
            return \json_encode(['success' => false]);
        }

        return \json_encode([
            'success' => true,
            'synonims' => $result->synonims
        ]);
    }
}
