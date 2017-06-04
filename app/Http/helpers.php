<?php

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

    return array_values($gifById);
}
