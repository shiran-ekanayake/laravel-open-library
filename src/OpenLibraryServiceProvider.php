<?php

namespace ShiranSE\OpenLibrary;

use ShiranSE\OpenLibrary\Commands\OpenLibraryCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class OpenLibraryServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-open-library')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-open-library_table')
            ->hasCommand(OpenLibraryCommand::class);
    }
}
