<?php

use App\Star;
use App\Gif;
use Illuminate\Support\Facades\Auth;

function convertToGifArray($gifs)
{
    $gifById = array_reduce($gifs, function($arr, $gif) {
        $go = new Gif($gif->id, $gif->url, false);
        $arr[$gif->id] = $go;
        return $arr;
    }, []);

    $ids = array_keys($gifById);
    if(Auth::check()) {
      $stars = Star::whereIn('gif_id', $ids)->where('user_id', Auth::user()->id)->get()->each(function($star) use ($gifById){
          $g = $gifById[$star->gif_id];
          $g->starred = true;
      });
    }

    return array_values($gifById);
}
