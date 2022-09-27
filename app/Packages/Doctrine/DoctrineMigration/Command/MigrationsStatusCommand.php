<?php

namespace App\Packages\Doctrine\DoctrineMigration\Command;

use Doctrine\Migrations\Tools\Console\Command\StatusCommand;

class MigrationsStatusCommand extends AbstractMigrationsBaseCommand
{
    protected $signature = 'doctrine:migrations:status';

    protected function getDoctrineMigrationConsoleEquivalentCommand()
    {
        return StatusCommand::getDefaultName();
    }
}
