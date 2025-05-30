<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api/v1')
                ->group(base_path('routes/api_v1.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(base_path('routes/event_log.php'));

            Route::middleware('web')
                ->group(base_path('routes/asmi_all.php'));

            Route::middleware('web')
                ->group(base_path('routes/asmi_auth.php'));

            Route::middleware('web')
                ->group(base_path('routes/number_edit.php'));

            Route::middleware('web')
                ->group(base_path('routes/number_detail.php'));

            Route::middleware('web')
                ->group(base_path('routes/express_notification.php'));

            Route::middleware('web')
                ->group(base_path('routes/debtors.php'));

            Route::middleware('web')
                ->group(base_path('routes/alert.php'));

            Route::middleware('web')
                ->group(base_path('routes/settings.php'));

            Route::middleware('web')
                ->group(base_path('routes/email_template.php'));

            Route::middleware('web')
                ->group(base_path('routes/fine_alert.php'));

            Route::middleware('web')
                ->group(base_path('routes/to_alert.php'));
        });
    }
}
