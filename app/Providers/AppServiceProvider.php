<?php

namespace App\Providers;

use App\Repositories\Timesheet\TimeSheetRepository;
use App\Repositories\Timesheet\TimeSheetRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            TimeSheetRepositoryInterface::class,
            TimeSheetRepository::class
        );
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
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