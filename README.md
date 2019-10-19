# Laravel Rating

[![Latest Version on Packagist](https://img.shields.io/packagist/v/canylmz/laravel-rating.svg?style=flat-square)](https://packagist.org/packages/canylmz/laravel-rating)
[![Latest Stable Version](https://poser.pugx.org/canylmz/laravel-rating/v/stable)](https://packagist.org/packages/canylmz/laravel-rating)
[![Build Status](https://img.shields.io/travis/canylmz/laravel-rating/master.svg?style=flat-square)](https://travis-ci.org/canylmz/laravel-rating)
[![codecov](https://codecov.io/gh/canylmz/laravel-rating/branch/master/graph/badge.svg)](https://codecov.io/gh/canylmz/laravel-rating)
[![Quality Score](https://img.shields.io/scrutinizer/g/canylmz/laravel-rating.svg?style=flat-square)](https://scrutinizer-ci.com/g/canylmz/laravel-rating)
[![StyleCI](https://styleci.io/repos/216253476/shield)](https://styleci.io/repos/216253476)
[![Total Downloads](https://poser.pugx.org/canylmz/laravel-rating/downloads)](https://packagist.org/packages/canylmz/laravel-rating)
[![License](https://poser.pugx.org/canylmz/laravel-rating/license)](https://packagist.org/packages/canylmz/laravel-rating)

Associate ratings to any Eloquent model.

This package is based on [rennokki/rating](https://github.com/rennokki/rating) with some improvements:
- BugFixes
- Exceptions
- Sum of ratings
- More testing

## Installation

Install this package with Composer:

``` bash
$ composer require canylmz/laravel-rating
```

The package will automatically register itself.

If your Laravel installation does not support package discovery, add this line in the providers array in your config/app.php file:

```php
Canylmz\Rating\RatingServiceProvider::class,
```

Optional: if you want to change the table name to something else than "ratings", you can publish the config file with:

```bash
php artisan vendor:publish --provider="Canylmz\Rating\RatingServiceProvider" --tag="config"
```

Publish the migration with:

```bash
php artisan vendor:publish --provider="Canylmz\Rating\RatingServiceProvider" --tag="migrations"
```

After the migration has been published you can create the ratings table by running the migration:

```bash
php artisan migrate
```

## Usage

### Prepare models

To allow a model to rate other models, it should use the `CanRate` trait and implement the `Rater` contract.

```php
use Canylmz\Rating\CanRate;
use Canylmz\Rating\Contracts\Rater;

class User extends Model implements Rater
{
    use CanRate;

    // ...
}
```

Each model that can be rated, should use the `CanBeRated` trait and implement the `Rateable` contract.

```php
use Canylmz\Rating\CanBeRated;
use Canylmz\Rating\Contracts\Rateable;

class Post extends Model implements Rateable
{
    use CanBeRated;

    // ...
}
```

If your model can both rate and be rated, you should use `Rate` trait and `Rating` contract.

```php
use Canylmz\Rating\Rate;
use Canylmz\Rating\Contracts\Rating;

class Member extends Model implements Rating
{
    use Rate;

    // ...
}
```

### Rate models

To rate other models, simply call `rate()` method.
As a second argument to the `rate()` method, you can pass the rating score. It can either be string, integer or float.

```php
$user->rate($post, 10);
$post->averageRating(User::class); // 10.0, as float
```

If you want to make sure a model gets rated only once, add `false` as the third argument to the `rate()` method.

```php
$user->rate($post, 10, false);
```

Check if a model has been rated with the `hasRated()` method.

```php
$user->rate($post, 10);
$user->hasRated($post); // true
```

Get the average rating of a model with the `averageRating()` method.
Pass the class name of the raters as the argument.
The return value is the average arithmetic value of all ratings as `float`.

```php
$user->rate($post, 10);
$post->averageRating(User::class); // 10.0, as float
```

Get the ratings count with the `countRatings()` method.

```php
$user->rate($post, 10);
$user->rate($post, 10);
$post->countRatings(User::class); // 2, as integer
```

## Testing

You can run the tests with:

``` bash
$ composer test
```

## Changelog

Please see the [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.


## Alternatives

- [rennoki/rating](https://github.com/rennokki/rating)
- [willvincent/laravel-rateable](https://github.com/willvincent/laravel-rateable)
- [AbdullahGhanem/rating](https://github.com/AbdullahGhanem/rating)

## Credits

- [Can YILMAZ](https://github.com/canylmz)
- [All Contributors](../../contributors)

## License

MIT. Please see the [license file](LICENSE.md) for more information.
