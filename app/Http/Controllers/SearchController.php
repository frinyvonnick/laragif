<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\GiphyInterface;
use App\Gif;
use Illuminate\Support\Facades\Auth;

class SearchController extends Controller
{
    const LIMIT = 20;

    private $giphy;

    public function __construct(GiphyInterface $giphy)
    {
        $this->giphy = $giphy;
    }

    public function search(string $term, int $offset)
    {
      $gifs = $this->giphy->search($term, self::LIMIT, $offset * self::LIMIT);
      return convertToGifArray($gifs);
    }

    public function index(string $term)
    {
        $gifs = $this->giphy->search($term, self::LIMIT, 0);
        return view('index', [
            'endpoint' => '/api/search/' . $term . '/',
            'search' => $term,
            'gifs' => convertToGifArray($gifs)
        ]);
    }
}
