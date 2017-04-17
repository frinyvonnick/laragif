<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\GiphyInterface;

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
        return $this->giphy->trending(self::LIMIT, $offset * self::LIMIT);
    }

    public function search(string $term, int $offset) {
      return $this->giphy->search($term, self::LIMIT, $offset * self::LIMIT);
    }

    public function index()
    {
        return view('index', [
            'gifs' => $this->giphy->trending(self::LIMIT, 0)
        ]);
    }
}
