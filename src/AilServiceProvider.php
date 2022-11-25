<?php

namespace Webid\Ail;

use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class AilServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('ail')
            ->hasConfigFile()
            ->hasRoute('web')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->publishConfigFile()
                    ->startWith(fn (InstallCommand $command) => $command->call('artisan vendor:publish', ['--tag' => 'ail-views']))
                    ->askToStarRepoOnGitHub('web-id-fr/ail');
            })
            ->hasViews();
    }
}
