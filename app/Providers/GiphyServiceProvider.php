<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Interfaces\GiphyInterface;
use App\Repositories\GiphyRepository;
use App\Repositories\MockGiphyRepository;

class GiphyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
