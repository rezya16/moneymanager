<?php

namespace App\Providers;

use App\Repository\WalletRepository;
use App\Repository\WalletRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(WalletRepositoryInterface::class,
            WalletRepository::class);
        Schema::defaultStringLength(191);
    }
}
