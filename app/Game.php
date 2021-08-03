<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = [
        'number',
        'time',
    ];

    public function checkNumber($guess)
    {
        $guess_digits = array_map('intval', str_split($guess));
        $original_digits = array_map('intval', str_split($this->number));

        $cows = 0;
        $bulls = 0;
        foreach($guess_digits as $i => $v)
        {
            if( $v == $original_digits[$i] ) {
                $bulls++;
            } elseif( array_search($v, $original_digits)!==false ){
                $cows++;
            }
        }

        return [
            'cows' => $cows,
            'bulls' => $bulls,
        ];
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
