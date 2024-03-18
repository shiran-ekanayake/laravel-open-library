# Laravel Wrapper for Open Library Api

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sse/laravel-open-library.svg?style=flat-square)](https://packagist.org/packages/sse/laravel-open-library)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/sse/laravel-open-library/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/sse/laravel-open-library/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/sse/laravel-open-library/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/sse/laravel-open-library/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/sse/laravel-open-library.svg?style=flat-square)](https://packagist.org/packages/sse/laravel-open-library)

The OpenLibrary PHP Package provides a convenient way to interact with the Open Library API in your PHP applications. With this package, you can easily search for books, authors, and other resources available on the Open Library platform. The package offers a fluent interface for creating and interacting with OpenLibraryAuthor and OpenLibraryBook objects, allowing you to retrieve detailed information about authors, including their works, biographies, and related metadata. Additionally, it provides seamless integration with Laravel, allowing you to use Laravel features like facades to access Open Library API with ease. Whether you're building a book catalog, integrating book data into your application, or simply exploring the vast collection of books available on Open Library, this package provides a powerful and intuitive solution for your needs.

## Support us

## Installation

You can install the package via composer:

```bash
composer require sse/laravel-open-library
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-open-library-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-open-library-config"
```

## Usage

```php
$works = OpenLibrary::searchWorks('Matilda');
$authors = OpenLibrary::searchAuthors('Rowling')
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Shiran Ekanayake](https://github.com/shiran-ekanayake)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
