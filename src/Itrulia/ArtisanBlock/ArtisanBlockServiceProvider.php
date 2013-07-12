<?php namespace Itrulia\ArtisanBlock;

use Illuminate\Support\ServiceProvider;

class ArtisanBlockServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 * @var bool
	 */
	protected $defer = true;

	public function boot() {
		$this->package('itrulia/artisan-block');
		$app = $this->app;
		//\Log::info($app['config']->get('artisan-block::driver', true));
	}

	/**
	 * Register the service provider.
	 * @return void
	 */
	public function register() {
		$this->app['artisan'] = $this->app->share(function ($app) {
			return new ArtisanBlockArtisan($app);
		});
	}

	/**
	 * Get the services provided by the provider.
	 * @return array
	 */
	public function provides() {
		return array('artisan');
	}

}