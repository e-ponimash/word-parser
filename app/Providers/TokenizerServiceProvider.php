<?php


namespace App\Providers;

use App\Services\TokenizerInterface;
use App\Services\TokenizerService;
use Illuminate\Support\ServiceProvider;
class TokenizerServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TokenizerInterface::class, function ($app){
            return new TokenizerService();
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
