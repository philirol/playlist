<?php

namespace App\Providers;
use App\Song;
use App\User;
use App\Policies\SongPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
        Song::class => SongPolicy::class
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('upload', function (User $user, $fileSize) {
            $bandStorage = $user->band->sizedir;
            return $bandStorage + $fileSize < 20000000 ;
        });
    }
}
