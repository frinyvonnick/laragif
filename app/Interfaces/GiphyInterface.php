<?php
namespace App\Interfaces;

interface GiphyInterface
{
    public function trending(int $limit, int $offset);
}
