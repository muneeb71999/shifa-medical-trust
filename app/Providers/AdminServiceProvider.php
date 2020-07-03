<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('admin', function () {
            return "<?php if (Auth::user()->is_admin) : ?>";
        });

        Blade::directive('endadmin', function () {
            return '<?php endif; ?>';
        });
    }
}
