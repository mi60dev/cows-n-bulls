<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Game;
use App\Score;

class GameController extends Controller
{
    private function createNumber() 
    {
        $num = substr(str_shuffle("123456789"), 0, 4);
        $array  = array_map('intval', str_split($num));

        if(count(array_intersect([1, 4, 5, 8], $array)) == count($array))
        {
            $this->createNumber();
        } else {
            $array = $this->rearrangeDigits($array);
            return implode('', $array);
        }
    }

    private function rearrangeDigits($digits)
    {
        //move 1 / 8
        usort($digits, function($a, $b) use ($digits) {
            if (in_array($b, [1, 8])) {
                return ($a==1 && $b==8) || ($a==8&&$b==1) ? 0 : 1;
            }
            return 0;
        });
        //move 4 / 5
        $intersect = array_intersect([4, 5], $digits);
        if (count($intersect) == 1) {
            $move = end($intersect); 
            array_splice($digits, array_search($move, $digits), 1);
            array_unshift($digits, $move);
        } else if (count($intersect) == 2) {
            array_splice($digits, array_search(4, $digits), 1);
            array_splice($digits, array_search(5, $digits), 1);
            array_splice($digits, 0, 0, [4]);
            array_splice($digits, 2, 0, [5]);
        }
        return $digits;
    }

    public function checkNumber($number) 
    {
        $game = auth()->user()->games()->orderBy('id', 'DESC')->first();
        $result = $game->checkNumber($number);
        if( $result['bulls']==4 )
        {
            $game->update([ 'time' => \Carbon\Carbon::now()->diffInSeconds(\Carbon\Carbon::parse($game->created_at)) ]);
            $result['number'] = $number;
            $result['tries'] = $game->tries;
        } else {
            $game->increment('tries');
        }
        return response()->json($result, 200);
    }

    public function start() 
    {
        $num = $this->createNumber();
        $game = auth()->user()->games()->create([ 'number' => $num ]);
        return response()->json($num, 200);
    }

    public function getHighScores()
    {
        $results = Game::whereNotNull('time')->orderBy('tries', 'ASC')->orderBy('time', 'ASC')->with('user')->limit(10)->get();
        $arr = [];
        foreach($results as $i => $result)
        {
            if(!isset($arr[$result->user->id])) {
                $arr[$result->user->id] = true;
            } else {
                unset($results[$i]);
            }
        }

        return response()->json($results, 200);
    }
}
