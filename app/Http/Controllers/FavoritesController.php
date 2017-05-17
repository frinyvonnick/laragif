<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\GiphyInterface;
use App\Gif;
use App\Events\StarEvent;
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

    public function isStarred(string $id) {
        $starred = !is_null(Star::where('user_id', Auth::user()->id)
                    ->where('gif_id', $id)
                    ->first());
        return json_encode((object)[
            'starred' => $starred
        ]);
    }

    public function index()
    {
        return view('index', [
            'endpoint' => '/api/favorites/',
            'gifs' => convertToGifArray($this->giphy->favorites(self::LIMIT, 0))
        ]);
    }
}
