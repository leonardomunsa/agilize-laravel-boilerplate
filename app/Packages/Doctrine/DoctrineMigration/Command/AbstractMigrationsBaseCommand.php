<?php

namespace App\Packages\Doctrine\DoctrineMigration\Command;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\StringInput;

abstract class AbstractMigrationsBaseCommand extends Command
{
    public function handle()
    {
        /** @var DoctrineMigrationCliFactory $factory */
        $factory = app(DoctrineMigrationCliFactory::class);
        $doctrineCliApplication = $factory->create();
        $doctrineCliApplication->run(new StringInput($this->getDoctrineMigrationConsoleEquivalentCommand()));
    }

    abstract protected function getDoctrineMigrationConsoleEquivalentCommand();
}
