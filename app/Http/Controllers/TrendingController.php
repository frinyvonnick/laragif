<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\GiphyInterface;

class TrendingController extends Controller
{
  private $giphy;

  public function __construct(GiphyInterface $giphy)
  {
      $this->giphy = $giphy;
  }

  public function trending(int $offset)
  {
    $gifs = $this->giphy->trending(20, $offset * 20);
    return convertToGifArray($gifs);
  }

  public function index()
  {
    return view('index', [
      'gifs' => convertToGifArray($this->giphy->trending(20, 0))
    ]);
  }
}