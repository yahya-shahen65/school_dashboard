<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepoServiceProviders extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'App\Repository\TeacherRepositoryInterface',
            'App\Repository\TeacherRepository');

        $this->app->bind(
            'App\Repository\StudentRepositoryInterface',
            'App\Repository\StudentRepository');

        $this->app->bind('App\Repository\SubjectRepositoryInterface',
            'App\Repository\SubjectRepository');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
