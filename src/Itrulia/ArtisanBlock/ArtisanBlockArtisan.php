<?php namespace Itrulia\ArtisanBlock;

class ArtisanBlockArtisan extends \Illuminate\Foundation\Artisan {

	/**
	 * Get the Artisan console instance.
	 * @return \Itrulia\ArtisanBlock\ArtisanBlockConsole
	 */
	protected function getArtisan() {
		if ( !is_null($this->artisan) ) {
			return $this->artisan;
		}

		$this->app->loadDeferredProviders();

		return $this->artisan = ArtisanBlockArtisan::start($this->app);
	}
}