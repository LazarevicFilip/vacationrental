<?php

namespace App\Providers;

use App\Models\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class AppServiceProvider extends ServiceProvider
{
    public function register()
    {

    }

    public function boot()
    {
        $menus = Menu::all();
        View::share("menus",$menus);
    }
}
