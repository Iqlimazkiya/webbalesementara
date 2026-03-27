<?php

namespace App\Providers;

use App\Helpers\ActivityLogger;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(Login::class, function (Login $event) {
            ActivityLogger::log(
                'Login',
                'Admin ' . $event->user->name . ' berhasil masuk ke sistem.'
            );
        });

        Event::listen(Logout::class, function (Logout $event) {
            if ($event->user) {
                ActivityLogger::log(
                    'Logout',
                    'Admin ' . $event->user->name . ' keluar dari sistem.'
                );
            }
        });
    }
}