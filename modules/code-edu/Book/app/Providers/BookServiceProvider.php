<?php

namespace CodeEdu\Book\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;

class BookServiceProvider extends ServiceProvider
{
    /**'
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Module Name
     * @var string
     */
    protected $moduleName = 'codeedubook';


    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->publishMigrationsAndSeeders();
        $this->publishAssets();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(AuthServiceProvider::class);

        // Vendors
        $this->app->register(\Folklore\Image\ImageServiceProvider::class);
        AliasLoader::getInstance()->alias('FImage', \Folklore\Image\Facades\Image::class);
    }

    /**
     * Register config.
     *
     * @return void
     */
    protected function registerConfig()
    {
        $this->publishes([
            __DIR__.'/../../config/config.php' => config_path($this->moduleName .'.php'),
        ], 'config');
        $this->mergeConfigFrom(
            __DIR__.'/../../config/config.php', $this->moduleName
        );
    }

    /**
         * Register views.
     *
     * @return void
     */
    public function registerViews()
    {
        $viewPath = resource_path('views/vendor/'. $this->moduleName);

        $sourcePath = __DIR__.'/../../resources/views';

        $this->publishes([
            $sourcePath => $viewPath
        ]);

        $this->loadViewsFrom(array_merge(array_map(function ($path) {
            return $path . '/vendor/'. $this->moduleName;
        }, \Config::get('view.paths')), [$sourcePath]), $this->moduleName);
    }

    /**
     * Register translations.
     *
     * @return void
     */
    public function registerTranslations()
    {
        $langPath = resource_path('lang/vendor/'. $this->moduleName);

        if (is_dir($langPath)) {
            $this->loadTranslationsFrom($langPath, $this->moduleName);
        } else {
            $this->loadTranslationsFrom(__DIR__ .'/../../resources/lang', $this->moduleName);
        }
    }

    /**
     * Register an additional directory of factories.
     * @source https://github.com/sebastiaanluca/laravel-resource-flow/blob/develop/src/Modules/ModuleServiceProvider.php#L66
     */
    public function registerFactories()
    {
        if (! app()->environment('production')) {
            app(Factory::class)->load(__DIR__ . '/database/factories');
        }
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }

    /**
     * Register all migrations and seeders
     *
     */
    public function publishMigrationsAndSeeders()
    {
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../../database/seeders' => database_path('seeds')
        ], 'seeders');
    }

    public function publishAssets()
    {
        $sourcePath = __DIR__.'/../../resources/assets/js';
        $libPath =   __DIR__.'/../../resources/assets/lib';

        $this->publishes([
            $sourcePath => public_path('js'),
            $libPath => base_path('resources/assets/js/vendor')
        ], 'assets');
    }
}
