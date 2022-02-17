<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Categories;
use App\Models\Products;
use App\Models\order;
use App\Models\orderdetail;
use App\Models\Comment;
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
        view()->composer(("layouts.header"),function($view)
        {
            $categories=Categories::all();
            $view->with("categories",$categories);
        });

        view()->composer(("admin.products"),function($view)
        {
            $categories=Categories::all();
            $view->with("categories",$categories);
        });

        view()->composer(("layouts.headerAdmin"),function($view)
        {
            $product=Products::all();
            $view->with("product",$product);
        });

        view()->composer(("pages.index"),function($view)
        {
            $categories=Categories::all();
            $view->with("categories",$categories);
        });

        Paginator::useBootstrap();

        view()->composer(("layouts.headerAdmin"),function($view)
        {
            $order=order::all();
            $view->with("order",$order);
        });

        view()->composer(("layouts.headerAdmin"),function($view)
        {
            $orderdetail=orderdetail::all();
            $view->with("orderdetail",$orderdetail);
        });
    }
}
