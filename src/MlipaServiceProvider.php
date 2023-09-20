<?php

namespace DatavisionInt\Mlipa;

use DatavisionInt\Mlipa\Commands\MlipaCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class MlipaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-mlipa')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-mlipa_table')
            ->hasCommand(MlipaCommand::class);
    }
}
