<?php

use App\Gif;

function convertToGifArray($gifs)
{
    $gifById = array_reduce($gifs, function($arr, $gif) {
        $go = new Gif($gif->id, $gif->url, false);
        $arr[$gif->id] = $go;
        return $arr;
    }, []);

    return array_values($gifById);
}
