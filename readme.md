# Minimalist

ArtisanBlock is a hook in to Artisan to block certain commands.

## Installation

Add `itrulia/artisan-block` to `composer.json`.

    "itrulia/artisan-block": "dev-master"

Run `composer update` to pull down the latest version of ArtisanBlock. Now open up `app/config/app.php` and add the service provider to your `providers` array.

    'providers' => array(
        'Itrulia\ArtisanBlock\ArtisanBlockServiceProvider',
    )

## Usage

until [pull#2179](https://github.com/laravel/laravel/pull/2179 "Pull request 2179") is pulled, you have to change

```php
$artisan = Illuminate\Console\Application::start($app);
```

to


```php
$app['artisan']->getArtisan();
```

and in console enter 

	php artisan config:publish  
