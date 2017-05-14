<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\GiphyInterface;
use App\Star;
use App\Gif;
use Illuminate\Support\Facades\Auth;

class TrendingController extends Controller
{
    const LIMIT = 20;

    private $giphy;

    public function __construct(GiphyInterface $giphy)
    {
        $this->giphy = $giphy;
    }

    public function trending(int $offset)
    {
        $gifs = $this->giphy->trending(self::LIMIT, $offset * self::LIMIT);
        return convertToGifArray($gifs);
    }

    public function index()
    {
        return view('index', [
            'endpoint' => '/api/trending/',
            'gifs' => convertToGifArray($this->giphy->trending(self::LIMIT, 0))
        ]);
    }
}
