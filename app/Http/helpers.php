<?php

use App\Star;
use App\Gif;

function convertToGifArray($gifs)
{
    $gifById = array_reduce($gifs, function($arr, $gif) {
        $go = new Gif($gif->id, $gif->url, false);
        $arr[$gif->id] = $go;
        return $arr;
    }, []);

    $ids = array_keys($gifById);

    $stars = Star::whereIn('gif_id', $ids)->get()->each(function($star) use ($gifById){
        $g = $gifById[$star->gif_id];
        $g->starred = true;
    });

    return array_values($gifById);
}
