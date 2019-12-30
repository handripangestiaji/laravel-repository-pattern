<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Console\GeneratorCommand;

class RepositoryInterface extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:repository-interface';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new repository interface';

    protected $type = 'Interface';

    private $interfaceClass;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    /*
    public function __construct()
    {
        parent::__construct();
    }
    */

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
            throw new InvalidArgumentException("Missing required argument interface name");
        }

        $stub = parent::replaceClass($stub, $name);

        return str_replace('DummyRepositoryInterface', $this->argument('name'), $stub);
    }

    /**
     * 
     * Get the stub file for the generator.
     *
     * @return string
     */
    protected function getStub()
    {
        return app_path() .'/Console/Commands/Stubs/repository-interface.stub';
    }
    /**
     * Get the default namespace for the class.
     *
     * @param  string  $rootNamespace
     * @return string
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Contract';
    }
}
