<?php
namespace App\Repositories;

use App\Interfaces\GiphyInterface;
use Kozz\Laravel\Facades\Guzzle;

class GiphyRepository implements GiphyInterface
{

    const GIPHY_API = 'http://api.giphy.com/v1/gifs/';
    const API_KEY = 'dc6zaTOxFJmzC';

    public static function ping()
    {
        try {
            Guzzle::get(self::GIPHY_API . 'random?api_key=' . self::API_KEY, ['connect_timeout' => 0.1]);
            return true;
        } catch (\GuzzleHttp\Exception\ConnectException $e) {
            return false;
        }
    }

    public function trending(int $limit, int $offset)
    {
        $response = Guzzle::get(self::GIPHY_API . 'trending?api_key=' . self::API_KEY . '&limit=' . $limit . '&offset=' . $offset);

        return ($this->extractResult($response));
    }

    public function search(string $term, int $limit, int $offset)
    {
        $response = Guzzle::get(self::GIPHY_API . 'search?api_key=' . self::API_KEY . '&q=' . $term . '&limit=' . $limit . '&offset=' . $offset);

        return $this->extractResult($response);
    }

    private function extractResult($response) {
      $data = json_decode($response->getBody())->data;

      return array_map(function ($datum) {
          return (object)[
              'url' => $datum->images->fixed_width->url
          ];
      }, $data);
    }
}
