<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Draw;
use App\Plate;
use App\PlateHistory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DrawController extends Controller
{
    private function store(){
        $old = Plate::orderBy('updated_at', 'desc')->first();
        if(!isset($old) || Carbon::now()->diffInMonths($old->updated_at) >= 2){
            //Fetch old image
            $currentPlate = Plate::all();
            $plateArray = [];
            foreach($currentPlate as $e){
                $plateArray[$e->x][$e->y] = $e->dot;
            }

            //Save plate
            if(isset($old)){
                $image = imagecreate(1000, 500);
                $black = imagecolorallocate($image, 0, 0, 0);
                $white = imagecolorallocate($image, 255, 255, 255);
                foreach($plateArray as $x => $_y){
                    foreach($_y as $y => $dot){
                        imagefilledrectangle($image, $x, $y, $x + 1, $y + 1, $dot ? $white : $black);
                    }
                }
                ob_start();
                imagepng($image);
                $png = ob_get_clean();
                Storage::put('public/images/'.$old->updated_at->toDateString().'.png', $png);
                $ph = new PlateHistory;
                $ph->date = $old->updated_at->toDateString();
                $ph->url = Storage::url('public/images/'.$old->updated_at->toDateString().'.png');
                $ph->save();
            }
            //Update
            foreach($this->get(true) as $e){
                if(isset($plateArray[$e->x][$e->y])){
                    $plateArray[$e->x][$e->y] = !$plateArray[$e->x][$e->y];
                } else {
                    $plateArray[$e->x][$e->y] = true;
                }

            }
            //Save new table
            foreach($plateArray as $x => $_y)
                foreach($_y as $y => $dot){
                    $p = Plate::updateOrCreate(['x' => $x, 'y' => $y], ['dot' => $dot]);
                    $p->save();
                }
        }

    }
    public function update(Request $request)
    {
        $this->store();
        if (!Auth::check())
            return response('Unauthorized', 403);
        $count = Draw::whereDate('created_at', Carbon::now())
            ->where('user_id', '=', Auth::user()->id)
            ->count();
        if(!is_array($request->input("points")))
            return 'B';
        foreach ($request->input("points") as $e) {
            if($count >= 100)
                break;
            $count++;
            $draw = new Draw();
            $draw->x = $e[0];
            $draw->y = $e[1];
            $draw->user = Auth::user()->name;
            $draw->user_id = Auth::user()->id;
            $draw->save();
        }

        return $count;
    }

    public function count(Request $request){
        if (!Auth::check())
            return response('Unauthorized', 403);
        return Draw::whereDate('created_at', Carbon::now())
        ->where('user_id', '=', Auth::user()->id)
        ->count();
    }

    public function get($ex = false){
        if($ex){
	    $old = Plate::orderBy('updated_at', 'desc')->first();
            return Draw::whereMonth(
                'created_at', '>=', $old->updated_at
            )->get();
        } else {
            return Draw::whereMonth(
                'created_at', '<=', Carbon::now()->subMonth()->month - 1
            )->get();
        }
    }

    public function plate(){
        $this->store();
        return PlateHistory::orderBy('created_at', 'desc')->firstOrFail();
    }
}
