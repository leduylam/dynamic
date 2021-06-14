<?php

namespace App\Providers;

use App\Models\Admin;
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
        Validator::extend('custom_unique_email', function($attribute, $value, $parameters)
        {
            $item = Admin::where('email', $value)->first();

            if(!empty($item)) {
                return false;
            }

            return true;
        });

        Validator::extend('custom_unique_email_edit', function($attribute, $value, $parameters)
        {
            $current_user_id = $parameters[0];

            $item = Admin::where('email', $value)->first();

            if(!empty($item)) {
                if ($current_user_id != $item->id) {
                    return false;
                }
            }

            return true;
        });

    }
}
