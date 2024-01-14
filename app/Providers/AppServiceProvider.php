<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        //custom blade directive for role check

        Blade::if('role',function ($arg){
           foreach (Auth::user()->roles as $role){
              if(in_array($role->slug,$arg)){
                  return true;
              }
           }

        });

//        Blade::if('role',function ($argument){
//            return Auth::user()->hasRoles($argument);
//        });

    }
}
