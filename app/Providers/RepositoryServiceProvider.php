<?php

	namespace App\Providers;

    use Illuminate\Support\ServiceProvider;

    class RepositoryServiceProvider extends ServiceProvider
	{
        public function boot() {
            $this->app->bind(
                'Domain\Modules\Course\Repositories\ICourseRepository',
                'App\Repositories\CourseRepository'
            );
        }
	}

