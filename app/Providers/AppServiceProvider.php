<?php

namespace App\Providers;

use App\Models\ChatMessage;
use App\Observers\ChatMessageObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        ChatMessage::observe(ChatMessageObserver::class);
        //
    }
}
