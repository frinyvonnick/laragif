<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\GiphyInterface;
use App\Gif;
use Illuminate\Support\Facades\Auth;

class FavoritesController extends Controller
{
    const LIMIT = 20;

    private $giphy;

    public function __construct(GiphyInterface $giphy)
    {
        $this->giphy = $giphy;
    }

    public function star(string $id)
    {
        $starred = true;

        // Etape 8

        return json_encode((object)[
            'id' => $id,
            'starred' => $starred
        ]);
    }

    public function favorites(int $offset)
    {
        $gifs = $this->giphy->favorites(self::LIMIT, $offset * self::LIMIT);
        return convertToGifArray($gifs);
    }

    public function index()
    {
        return view('index', [
            'endpoint' => '/api/favorites/',
            'gifs' => convertToGifArray($this->giphy->favorites(self::LIMIT, 0))
        ]);
    }
}
