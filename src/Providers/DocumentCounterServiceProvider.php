<?php

namespace Ptsilva\DocumentCounter\Providers;

use Illuminate\Support\ServiceProvider;
use Ptsilva\DocumentCounter\Factory\DocumentCounterFactory;

class DocumentCounterServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configKey = 'document-counter';

        $app = $this->app;

        $app->singleton('document-counter', function($app) use ($configKey){

            $factory = new DocumentCounterFactory();

            $factory->registerCounters(['pdf' => function() use ($configKey, $app){

                $driverkey = $app['config']->get("{$configKey}.pdf.driver");

                $binPath = $app['config']->get("{$configKey}.pdf.{$driverkey}.bin");
                $handler = $app['config']->get("{$configKey}.pdf.{$driverkey}.handler");

                return new $handler($binPath);
            }]);


            return $factory;
        });

        $app->bind(DocumentCounterFactory::class, 'document-counter');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->publishes([
            __DIR__.'/../../config/document-counter.php' => config_path('document-counter.php'),
        ]);
    }
}
