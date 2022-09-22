<?php

namespace App\Providers;

use App\Packages\Doctrine\DoctrineMigration\Command\MigrationsDiffCommand;
use App\Packages\Doctrine\DoctrineMigration\Command\MigrationsMigrateCommand;
use App\Packages\Doctrine\DoctrineMigration\Command\MigrationsStatusCommand;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerCommands();
    }
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    private function registerCommands(): void
    {
        $this->commands(
            [
                MigrationsMigrateCommand::class,
                MigrationsDiffCommand::class,
                MigrationsStatusCommand::class
            ]
        );
    }
}
