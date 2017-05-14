<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\GiphyInterface;
use App\Star;
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
        $star = Star::where('user_id', Auth::user()->id)
                    ->where('gif_id', $id)
                    ->first();

        if(is_null($star)) {
            $star = new Star([
                'user_id' => Auth::user()->id,
                'gif_id' => $id
            ]);

            $star->save();
        } else {
            $star->delete();
            $starred = false;
        }

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