<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Draw;
use Illuminate\Support\Carbon;

class DrawController extends Controller
{
    public function update(Request $request)
    {
        foreach ($request->input("points") as $e) {
            $draw = new Draw();
            $draw->x = $e[0];
            $draw->y = $e[1];
            $draw->save();
        }
        return "OK";
    }
    public function get()
    {
        $draw = Draw::whereMonth(
            'created_at', '>=', Carbon::now()->subMonth()->month - 1
        )->get();
        return $draw;
    }
}
