<?php

namespace ThatsUs\RedLock;

use Illuminate\Support\ServiceProvider;
use ThatsUs\RedLock\RedLock;
use Illuminate\Support\Facades\Redis;

class RedLockServiceProvider extends ServiceProvider{
    /**
     * bootstrap, add routes
     */
    public function boot()
    {

    }

    /**
     * register the service provider
     */
    public function register()
    {
        // store to container
        $this->app->singleton('redlock', function ($app) {
            return new RedLock(
                [Redis::connection()],
                config('database.redis.redis_lock.retry_delay'), 
                config('database.redis.redis_lock.retry_count')
            );
        });
    }
}