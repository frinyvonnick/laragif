<?php
namespace App\Repositories;

use App\Interfaces\GiphyInterface;
use Kozz\Laravel\Facades\Guzzle;

class GiphyRepository implements GiphyInterface
{

    const GIPHY_API = 'http://api.giphy.com/v1/gifs/';
    const API_KEY = 'dc6zaTOxFJmzC';

    public function trending(int $limit, int $offset)
    {
        return Guzzle::get(self::GIPHY_API . 'trending?api_key=' . self::API_KEY . '&limit=' . $limit . '&offset=' . $offset)->getBody();
    }
}
