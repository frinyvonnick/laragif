<?php
namespace App\Repositories;

use App\Interfaces\GiphyInterface;
use App\Http\Controllers\GifsController;

class MockGiphyRepository implements GiphyInterface
{

    public function trending(int $limit, int $offset)
    {
        $file = base_path() . '/resources/mocks/trending/' . ($offset / GifsController::LIMIT) . '.json';

        if (file_exists($file)) {
            return json_decode(file_get_contents($file));
        }

        // Fallback on first json mock if we don't find a mock file
        return json_decode(file_get_contents(base_path() . '/resources/mocks/trending/0.json'));
    }
}
