<?php namespace Itrulia\ArtisanBlock;

class ArtisanBlockConsole extends \Illuminate\Console\Application{

	/**
	 * @var \Illuminate\Foundation\Application
	 */
	protected static $app;

	/**
	 * Start a new Console application.
	 *
	 * @param  \Illuminate\Foundation\Application  $app
	 * @return \Illuminate\Console\Application
	 */
	public static function start($app)
	{
		static::$app = $app;
		$artisan = new ArtisanBlockConsole('Laravel Framework', $app::VERSION);
		$app->instance('artisan', $artisan);
		$artisan->setExceptionHandler($app['exception']);
		$artisan->setLaravel($app);
		require $app['path'].'/start/artisan.php';
		$artisan->setAutoExit(false);

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
		$driver = static::$app['config']->get('artisan-block::driver');
		$commands = static::$app['config']->get('artisan-block::' .  $driver);

		if ($driver == 'blacklisted'){
			foreach($commands as $command){
				if (str_is($command, $name)){
					throw new \InvalidArgumentException(sprintf('Command "%s" is blacklisted.', $name));
				}
			}
		} elseif ($driver == 'whitelisted') {
			$is_okay = false;
			foreach($commands as $command){
				if (str_is($command, $name)){
					$is_okay = true;
				}
			}

			if (!$is_okay){
				throw new \InvalidArgumentException(sprintf('Command "%s" is not whitelisted.', $name));
			}
		} else {
			assert(false);
		}

		return parent::find($name);
	}
}