<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\GiphyInterface;
use App\Star;
use App\Gif;

class GifsController extends Controller
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
        return $this->convertToGifArray($gifs);
    }

    public function search(string $term, int $offset)
    {
      $gifs = $this->giphy->search($term, self::LIMIT, $offset * self::LIMIT);
      return $this->convertToGifArray($gifs);
    }

    public function star($id)
    {
        $starred = true;
        $star = Star::where('user_id', 1) // TODO retrieve logged user_id
                    ->where('gif_id', $id)
                    ->first();

        if(is_null($star)) {
            $star = new Star([
                'user_id' => 1, // TODO retrieve logged user_id
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

    public function index()
    {
        return view('index', [
            'gifs' => $this->convertToGifArray($this->giphy->trending(self::LIMIT, 0))
        ]);
    }

    private function convertToGifArray($gifs)
    {
        $gifById = array_reduce($gifs, function($arr, $gif){
            $go = new Gif;
            $go->url = $gif-> url;
            $go->id = $gif->id;
            $go->starred = false;
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
}
