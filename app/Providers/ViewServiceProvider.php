<?php

namespace App\Providers;

use App\Http\View\Composers\AdministratorNavigationComposer;
use App\Http\View\Composers\UserNavigationComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('components.admin-header', AdministratorNavigationComposer::class);
        View::composer('components.user-navigation', UserNavigationComposer::class);
    }
}
