<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Draw;
use App\Plate;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DrawController extends Controller
{

    public function update(Request $request)
    {
        if (!Auth::check())
            return response('Unauthorized', 403);
        foreach ($request->input("points") as $e) {
            $draw = new Draw();
            $draw->x = $e[0];
            $draw->y = $e[1];
            $draw->user = Auth::user()->name;
            $draw->user_id = Auth::user()->id;
            $draw->save();
        }

        return "OK";
    }
}
