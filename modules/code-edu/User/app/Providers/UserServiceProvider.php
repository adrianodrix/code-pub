<?php namespace CodeEdu\User\Providers;

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\Common\Annotations\CachedReader;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Cache\FilesystemCache;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Foundation\AliasLoader;
use Laravel\Cashier\CashierServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Module Name
     * @var string
     */
    protected $moduleName = 'codeeduuser';

    /**
     * Boot the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMiddlewares();
        $this->registerTranslations();
        $this->registerConfig();
        $this->registerViews();
        $this->registerFactories();
        $this->registerCommands();
        $this->publishMigrationsAndSeeders();
    }

    public function registerCommands()
    {
      if ($this->app->runningInConsole()) {
        $this->commands([
            \CodeEdu\User\Console\CreatePermissionCommand::class,
        ]);
      }
    }

    /**
     * Register Middlewares
     */
    public function registerMiddlewares()
    {
        $this->app['router']->aliasMiddleware('isVerified', \Jrean\UserVerification\Middleware\IsVerified::class);
        $this->app['router']->aliasMiddleware('auth.resource', \CodeEdu\User\Http\Middleware\AuthorizationResourceMiddleware::class);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerPackagesEnv();
        $this->registerAliases();
        $this->registerAnnotations();

        $this->app->register(AuthServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(CashierServiceProvider::class);
    }

    public function registerPackagesEnv()
    {
        $this->app->register(\Jrean\UserVerification\UserVerificationServiceProvider::class);
    }

    public function registerAliases()
    {
        AliasLoader::getInstance()->alias('UserVerification', \Jrean\UserVerification\Facades\UserVerification::class);
        AliasLoader::getInstance()->alias('NavBarAuth', \CodeEdu\User\Facade\NavBarAuthorizationFacade::class);
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
        if (! $this->app->environment('production')) {
            $this->app->make(Factory::class)->load(__DIR__ . '/../database/factories');
        }
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

    public function registerAnnotations()
    {
        $loader = require base_path() .'/vendor/autoload.php';
        AnnotationRegistry::registerLoader([$loader, 'loadClass']);

        $this->registerAnnotationReader();
    }

    public function registerAnnotationReader()
    {
        $this->app->bind(Reader::class, function () {
           return new CachedReader(
               new AnnotationReader(),
               new FilesystemCache(storage_path('framework/cache/doctrine-annotations')),
               $debug = config('app.debug')
           );
        });
    }
}
