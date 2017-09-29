<?php

namespace App\Providers;

use Laravel\Passport\Passport;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Hashing\BcryptHasher;
use Illuminate\Support\Facades\Auth;
use App\Extensions\MastiffUserProvider;
use Carbon\Carbon;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        $this->_configPassport();
        $this->_registerMastiffUserProvider();
    }

    /**
     * Config Passport
     *
     * return void
     */
    private function _configPassport()
    {
        Passport::routes();
        Passport::tokensExpireIn(Carbon::now()->addDays(15));
        Passport::refreshTokensExpireIn(Carbon::now()->addDays(30));
    }

    /**
     * Register UserProvider
     *
     * @return void
     */
    private function _registerMastiffUserProvider()
    {
        Auth::provider('mastiff', function ($app, array $config) {
            return new MastiffUserProvider(new BcryptHasher(), config('auth.providers.mastiff.model'));
        });
    }
}
