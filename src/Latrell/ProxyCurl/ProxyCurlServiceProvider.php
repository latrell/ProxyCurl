<?php

namespace Latrell\ProxyCurl;

use Curl\Curl;
use Illuminate\Support\ServiceProvider;
use Latrell\ProxyCurl\Console\CurlCommand;
use Latrell\ProxyCurl\Console\ShortS5ProxyCommand;

class ProxyCurlServiceProvider extends ServiceProvider
{
	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @deprecated Implement the \Illuminate\Contracts\Support\DeferrableProvider interface instead. Will be removed in Laravel 5.9.
	 *
	 * @var bool
	 */
	protected $defer = true;

	/**
	 * Bootstrap services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__ . '/../../../config/config.php' => config_path('proxy-curl.php')
		]);
	}

	/**
	 * Register services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__ . '/../../../config/config.php', 'proxy-curl');

		$this->app->singleton('proxy-curl', function ($app) {
			$enable = $app->config->get('proxy-curl.enable');
			$pack = $app->config->get('proxy-curl.pack');
			$time = $app->config->get('proxy-curl.time');
			$interval = $app->config->get('proxy-curl.interval');
			$strict = $app->config->get('proxy-curl.strict');
			return new ProxyCurl($enable, $pack, $time, $interval, $strict);
		});

		$this->registerCommands();
	}

	/**
	 * Register the lock related console commands.
	 *
	 * @return void
	 */
	public function registerCommands()
	{
		$this->app->singleton('command.proxy-curl.curl', function () {
			return new CurlCommand();
		});
		$this->app->singleton('command.proxy-curl.short-s5', function () {
			return new ShortS5ProxyCommand();
		});

		$this->commands([
			'command.proxy-curl.curl',
			'command.proxy-curl.short-s5',
		]);
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [
			'proxy-curl',
			'command.proxy-curl.curl',
			'command.proxy-curl.short-s5',
		];
	}
}
