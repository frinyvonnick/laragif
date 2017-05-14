<?php
namespace App\Repositories;

use App\Interfaces\GiphyInterface;

class MockGiphyRepository implements GiphyInterface
{

    public function trending(int $limit, int $offset)
    {
        $file = base_path() . '/resources/mocks/trending/' . ($offset / $limit) . '.json';

        if (file_exists($file)) {
            return json_decode(file_get_contents($file));
        }

        // Fallback on first json mock if we don't find a mock file
        return json_decode(file_get_contents(base_path() . '/resources/mocks/trending/0.json'));
    }

    public function search(string $term, int $limit, int $offset)
    {
        $file = base_path() . '/resources/mocks/search/' . $term . '/' . $offset . '.json';

        if (file_exists($file)) {
            return json_decode(file_get_contents($file));
        }

        // Fallback on first json mock if we don't find a mock file
        return json_decode(file_get_contents(base_path() . '/resources/mocks/search/cat/0.json'));
    }

    public function favorites(int $limit, int $offset)
    {

    }
}
