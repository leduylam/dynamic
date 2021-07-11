<?php

namespace App\Providers;

use App\Http\Middleware\LocaleMiddleware;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Color;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\Size;
use App\Models\User;
use Illuminate\Support\Facades\View;
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
        $this->app->singleton(LocaleMiddleware::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('custom_unique_email', function ($attribute, $value, $parameters) {
            $item = Admin::where('email', $value)->first();

            if (!empty($item)) {
                return false;
            }

            return true;
        });

        /**
         * custom unique email
         */
        Validator::extend('custom_unique_email_edit', function ($attribute, $value, $parameters) {
            $current_user_id = $parameters[0];
            $item = Admin::where('email', $value)->first();
            if (!empty($item)) {
                if ($current_user_id != $item->id) {
                    return false;
                }
            }

            return true;
        });

        /**
         * user unique email
         */
        Validator::extend('user_unique_email', function ($attribute, $value, $parameters) {
            $item = User::where('email', $value)->first();

            if (!empty($item)) {
                return false;
            }

            return true;
        });

        /**
         * custom unique email
         */
        Validator::extend('user_unique_email_edit', function ($attribute, $value, $parameters) {
            $current_user_id = $parameters[0];
            $item = User::where('email', $value)->first();
            if (!empty($item)) {
                if ($current_user_id != $item->id) {
                    return false;
                }
            }

            return true;
        });

        Validator::extend('user_unique_sku', function ($attribute, $value, $parameters) {
            $item = User::where('sku', $value)->first();

            if (!empty($item)) {
                return false;
            }

            return true;
        });

        /**
         * custom unique email
         */
        Validator::extend('user_unique_sku_edit', function ($attribute, $value, $parameters) {
            $current_user_id = $parameters[0];
            $item = User::where('sku', $value)->first();
            if (!empty($item)) {
                if ($current_user_id != $item->id) {
                    return false;
                }
            }

            return true;
        });

        Validator::extend('custom_unique_sku_edit', function ($attribute, $value, $parameters) {
            $id = $parameters[0];
            $item = Product::where('sku', $value)->first();
            if (!empty($item)) {
                if ($id != $item->id) {
                    return false;
                }
            }

            return true;
        });

        Validator::extend('check_sku_order_edit', function ($attribute, $value, $parameters) {
            $id = $parameters[0];
            $item = Order::where('sku', $id)->first();
            if (!empty($item)) {
                if ($value != $item->id) {
                    return false;
                }
            }

            return true;
        });

        Validator::extend('check_sku_user', function ($attribute, $value, $parameters) {

            $item = User::where('sku', $value)->first();
            if (empty($item)) {
                return false;
            }

            return true;
        });

        Validator::extend('check_sku_product', function ($attribute, $value, $parameters) {

            $item = Product::where('sku', $value)->first();
            if (empty($item)) {
                return false;
            }

            return true;
        });

        Validator::extend('check_category_big', function ($attribute, $value, $parameters) {
            $item = Category::find($value);
            if (empty($item)) {
                return false;
            }

            return true;
        });

        Validator::extend('check_category_mid', function ($attribute, $value, $parameters) {
            $item = Category::where('parent_id_1', $parameters[0])->where('parent_id_2', 0)->pluck('id')->toArray();
            if (in_array($value, $item)) {
                return true;
            }

            return false;
        });

        Validator::extend('check_category_small', function ($attribute, $value, $parameters) {
            $item = Category::where('parent_id_1', $parameters[0])->where('parent_id_2', $parameters[1])->pluck('id')->toArray();
            if (in_array($value, $item)) {
                return true;
            }

            return false;
        });

        Validator::extend('check_product_detail', function ($attribute, $value, $parameters) {
            $item = ProductDetail::find($value);
            if (empty($item)) {
                return false;
            }

            return true;
        });

        Validator::extend('check_color', function ($attribute, $value, $parameters) {
            $item = Color::find($value);
            if (empty($item)) {
                return false;
            }

            return true;
        });

        Validator::extend('check_size', function ($attribute, $value, $parameters) {
            $item = Size::find($value);
            if (empty($item)) {
                return false;
            }

            return true;
        });

        $categories = Category::all();
        View::share('categories', $categories);
    }
}
