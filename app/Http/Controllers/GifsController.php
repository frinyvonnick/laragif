<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\GiphyRepository;

class GifsController extends Controller
{
    const LIMIT = 20;

    private $giphy;

    public function __construct(GiphyRepository $giphy)
    {
        $this->giphy = $giphy;
    }

    public function trending(int $offset)
    {
        return json_decode($this->giphy->trending(self::LIMIT, $offset))->data;
    }

    public function index()
    {
        return view('index', [
            'gifs' => json_decode($this->giphy->trending(self::LIMIT, 0))->data
        ]);
    }
}
