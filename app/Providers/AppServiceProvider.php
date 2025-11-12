<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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

      Validator::extend('validateNumbers', function ($attribute, $value, $parameters, $validator) {
        $numbers = explode(',', $value);
        foreach ($numbers as $number) {
            if (!is_numeric($number)) {
                return false;
            }
        }

        return true;
       });
    }
}
