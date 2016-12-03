<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
		// construct a main navigation
		$navItems = array(
			array(

				'title' => 'home',
				'url'   => '/',
			),
			array(

				'title' => 'articles',
				'url'   => 'articles',
			)
		);

		view()->composer(['app','debug.app','release.app'], function ($view) use ($navItems) {
			$view->with('navItems', $navItems);
		});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
