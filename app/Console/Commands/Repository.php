<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class Repository extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository class';

    protected $type = "Repository";

    /**
     * Build the class with the given name.
     *
     * @param  string  $name
     * @return string
     */
    protected function buildClass($name)
    {
        $stub = parent::buildClass($name);

        $model = $this->option('model');
        $interface = $this->option('interface');

        $stub = $interface ? $this->replaceInterface($stub, $interface) : $stub;

        return $model ? $this->replaceModel($stub, $model) : $stub;
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

        return str_replace('DummyRepository', $this->argument('name'), $stub);
    }

    /**
     * Replace the model for the given stub.
     *
     * @param  string  $stub
     * @param  string  $model
     * @return string
     */
    protected function replaceModel($stub, $model)
    {
        $model = str_replace('/', '\\', $model);

        $namespaceModel = $this->laravel->getNamespace().$model;

        if (Str::startsWith($model, '\\')) {
            $stub = str_replace('NamespacedDummyModel', trim($model, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedDummyModel', $namespaceModel, $stub);
        }

        $stub = str_replace(
            "use {$namespaceModel};\nuse {$namespaceModel};", "use {$namespaceModel};", $stub
        );

        $model = class_basename(trim($model, '\\'));

        $dummyModel = Str::camel($model) === 'user' ? 'model' : $model;

        $stub = str_replace('dummyModel', Str::camel($dummyModel), $stub);

        return str_replace('DummyModel', $model, $stub);
    }

    /**
     * Replace the repository for the given stub.
     *
     * @param  string  $stub
     * @param  string  $interface
     * @return string
     */
    protected function replaceInterface($stub, $interface)
    {
        $interface = str_replace('/', '\\', $interface);

        $namespaceInterface = $this->laravel->getNamespace().$interface;

        if (Str::startsWith($interface, '\\')) {
            $stub = str_replace('NamespacedDummyInterface', trim($interface, '\\'), $stub);
        } else {
            $stub = str_replace('NamespacedDummyInterface', $namespaceInterface, $stub);
        }

        $stub = str_replace(
            "use {$namespaceInterface};\nuse {$namespaceInterface};", "use {$namespaceInterface};", $stub
        );

        $interface = class_basename(trim($interface, '\\'));

        return str_replace('DummyInterface', $interface, $stub);
    }

    /**
     * 
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return app_path() .'/Console/Commands/Stubs/repository.stub';
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Repository';
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['model', 'm', InputOption::VALUE_OPTIONAL, 'The model that the repository applies to'],
            ['interface', 'i', InputOption::VALUE_OPTIONAL, 'The interface that the repository implements to'],
        ];
    }
}
