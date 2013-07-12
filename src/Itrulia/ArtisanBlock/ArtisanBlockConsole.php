<?php namespace Itrulia\ArtisanBlock;

class ArtisanBlockConsole extends \Illuminate\Console\Application{

	/**
	 * Start a new Console application.
	 *
	 * @param  \Illuminate\Foundation\Application  $app
	 * @return \Illuminate\Console\Application
	 */
	public static function start($app)
	{
		$artisan = new ArtisanBlockConsole('Laravel Framework', $app::VERSION);
		$app->instance('artisan', $artisan);
		$artisan->setExceptionHandler($app['exception']);
		$artisan->setLaravel($app);
		require $app['path'].'/start/artisan.php';
		$artisan->setAutoExit(false);
		// If the event dispatcher is set on the application, we will fire an event
		// with the Artisan instance to provide each listener the opportunity to
		// register their commands on this application before it gets started.
		if (isset($app['events']))
		{
			$app['events']->fire('artisan.start', array($artisan));
		}

		return $artisan;
	}

	/**
	 * @param string $name
	 * @return \Symfony\Component\Console\Command\Command
	 */
	public function find($name)
	{
		echo \Cache::get('itrulia/artisan-block::driver');
		return parent::find($name);
	}
}