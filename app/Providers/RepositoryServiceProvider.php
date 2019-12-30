<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $repos = array(
            'Foo'
        );

        foreach ($repos as $repo) {
            $this->app->bind("App\Contract\\{$repo}RepositoryInterface", "App\Repository\\{$repo}Repository");
        }
    }
}
