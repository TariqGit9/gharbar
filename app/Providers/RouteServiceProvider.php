<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Config;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * This is used by Laravel authentication to redirect users after login.
     *
     * @var string
     */
    public const HOME = '/home';
    protected $namespace = 'App\Http\Controllers';

    /**
     * The controller namespace for the application.
     *
     * When present, controller route declarations will automatically be prefixed with this namespace.
     *
     * @var string|null
     */
    // protected $namespace = 'App\\Http\\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();
        // Config::set('auth.guards.api.provider', request()->input('provider', $this->stringStartsWith(request()->path(), 'api.super-admin') ? 'superadmins' : 'users'));
        $this->routes(function () {
            Route::prefix('api')
                ->middleware('api')
                ->namespace($this->namespace)
                ->group(base_path('routes/api.php'));
           
            Route::middleware('web')
                ->namespace($this->namespace)
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
    // function stringStartsWith($haystack,$needle,$case=true) {
    //     if ($case){
    //         return strpos($haystack, $needle, 0) === 0;
    //     }
    //     return stripos($haystack, $needle, 0) === 0;
    // }
    
    // function stringEndsWith($haystack,$needle,$case=true) {
    //     $expectedPosition = strlen($haystack) - strlen($needle);
    //     if ($case){
    //         return strrpos($haystack, $needle, 0) === $expectedPosition;
    //     }
    //     return strripos($haystack, $needle, 0) === $expectedPosition;
    // }
}
