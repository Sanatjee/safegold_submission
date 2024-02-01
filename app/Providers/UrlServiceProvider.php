<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\UrlRepository;

class UrlServiceProvider extends ServiceProvider
{
    
    public function register()
    {
        $this->app->bind(UrlRepository::class, function ($app) {
            return new UrlRepository();
        });
    }

    public function boot()
    {
        //
    }
}
