<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class Service extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:service';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new service class';

    protected $type = 'Service';

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $interface = $this->option('interface');

        return $interface ? $this->replaceRepository($stub, $interface) : $stub;
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param  string  $stub
     * @param  string  $name
     * @return string
     */
    protected function replaceClass($stub, $name)
    {
        if(!$this->argument('name')){
            throw new InvalidArgumentException("Missing required argument repository name");
        }

        $stub = parent::replaceClass($stub, $name);

        $interface = $this->option('interface');

        $stub = str_replace('DummyInterface', $interface, $stub);

        return str_replace('DummyService', $this->argument('name'), $stub);
    }

    /**
     * Replace the repository for the given stub.
     *
     * @param  string  $stub
     * @param  string  $interface
     * @return string
     */
    protected function replaceRepository($stub, $repo)
    {
        $repo = str_replace('/', '\\', $repo);

        $namespaceRepo = $this->laravel->getNamespace().$repo;

        if (Str::startsWith($repo, '\\')) {
            $stub = str_replace('NamespacedRepository', trim($repo, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedRepository', $namespaceRepo, $stub);
        }

        $stub = str_replace(
            "use {$namespaceRepo};\nuse {$namespaceRepo};", "use {$namespaceRepo};", $stub
        );

        $repo = class_basename(trim($repo, '\\'));

        return str_replace('DummyRepo', $repo, $stub);
    }

    /**
     * 
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return app_path() .'/Console/Commands/Stubs/service.stub';
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Service';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['interface', 'i', InputOption::VALUE_OPTIONAL, 'The interface that the repository implements to'],
        ];
    }
}
