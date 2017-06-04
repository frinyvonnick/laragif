<?php
namespace App\Interfaces;

interface GiphyInterface
{
    public function trending(int $limit, int $offset);
    public function search(string $term, int $limit, int $offset);
}
