<?php


namespace App\Providers;

use App\Services\StoreInterface;
use App\Services\StoreService;
use Illuminate\Support\ServiceProvider;
class StoreServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StoreInterface::class, function ($app){
            return new StoreService();
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
