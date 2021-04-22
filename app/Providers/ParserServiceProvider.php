<?php


namespace App\Providers;

use App\Services\ParserInterface;
use App\Services\ParserService;
use Illuminate\Support\ServiceProvider;
class ParserServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ParserInterface::class, function ($app){
            return new ParserService();
        });

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

}
