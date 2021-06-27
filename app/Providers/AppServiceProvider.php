<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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

        /**
         * custom unique email
         */
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

        Validator::extend('custom_unique_sku_edit', function($attribute, $value, $parameters)
        {
            $id = $parameters[0];
            $item = Product::where('sku', $value)->first();
            if(!empty($item)) {
                if ($id != $item->id) {
                    return false;
                }
            }

            return true;
        });

        Validator::extend('check_sku_order_edit', function($attribute, $value, $parameters)
        {
            $id = $parameters[0];
            $item = Order::where('sku', $id)->first();
            if(!empty($item)) {
                if ($value != $item->id) {
                    return false;
                }
            }

            return true;
        });

        Validator::extend('check_sku_user', function($attribute, $value, $parameters)
        {

            $item = User::where('sku', $value)->first();
            if(empty($item)) {
                    return false;
            }

            return true;
        });

        Validator::extend('check_sku_product', function($attribute, $value, $parameters)
        {

            $item = Product::where('sku', $value)->first();
            if(empty($item)) {
                    return false;
            }

            return true;
        });

    }
}
