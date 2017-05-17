<?php
namespace App\Repositories;

use App\Interfaces\GiphyInterface;
use Kozz\Laravel\Facades\Guzzle;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Facades\Auth;
use App\Star;

class GiphyRepository implements GiphyInterface
{

    const GIPHY_API = 'http://api.giphy.com/v1/gifs';
    const API_KEY = 'dc6zaTOxFJmzC';

    public static function ping()
    {
        try {
            Guzzle::get(self::GIPHY_API . '/random?api_key=' . self::API_KEY, ['connect_timeout' => 1]);
            return true;
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return false;
        }
    }

    public function trending(int $limit, int $offset)
    {
        $response = Guzzle::get(self::GIPHY_API . '/trending?api_key=' . self::API_KEY . '&limit=' . $limit . '&offset=' . $offset);

        return (self::extractResult($response));
    }

    public function search(string $term, int $limit, int $offset)
    {
        $response = Guzzle::get(self::GIPHY_API . '/search?api_key=' . self::API_KEY . '&q=' . $term . '&limit=' . $limit . '&offset=' . $offset);

        return self::extractResult($response);
    }

    public function favorites(int $limit, int $offset)
    {
        $ids = Star::take($limit)
                  ->where('user_id', Auth::user()->id)
                  ->skip($offset)
                  ->get()
                  ->implode('gif_id', ',');

        $response = Guzzle::get(self::GIPHY_API . '?api_key=' . self::API_KEY . '&ids=' . $ids);

        return self::extractResult($response);
    }

    private static function extractResult(Response $response)
    {
        $data = json_decode($response->getBody())->data;

        return array_map(function(\stdClass $datum) {
          return (object)[
              'id' => $datum->id,
              'url' => $datum->images->fixed_width->url
          ];
        }, $data);
    }
}
