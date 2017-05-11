<?php

namespace App;

class Gif
{
    public $id;
    public $url;
    public $starred;

    function __construct($id, $url, $starred)
    {
        $this->id = $id;
        $this->url = $url;
        $this->starred = $starred;
    }
}
