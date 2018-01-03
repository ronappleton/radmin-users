<?php

namespace RonAppleton\Radmin\Users;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Events\Dispatcher;
use RonAppleton\MenuBuilder\Traits\AddsMenu;

class ModuleServiceProvider extends ServiceProvider
{
    use AddsMenu;
    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'RonAppleton\Radmin\Users\Http\Controllers';


    /**
     * Create a new service provider instance.
     *
     * @param  \Illuminate\Contracts\Foundation\Application  $app
     * @return void
     */
    public function __construct($app)
    {
        parent::__construct($app);
        $this->app = $app;
    }

    public function boot(Dispatcher $events)
    {
        $this->loadRoutesFrom(__DIR__ . '/Http/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');
        $this->loadViews();
        $this->publishConfig();
        $this->menuListener($events);
    }

    public function register()
    {
    }


    private function publishConfig()
    {
        $configPath = $this->packagePath('config/radmin-users.php');

        $this->publishes([
            $configPath => config_path('radmin-users.php'),
        ], 'config');

        $this->mergeConfigFrom($configPath, 'radmin-users');
    }

    private function packagePath($path)
    {
        return __DIR__ . "/../$path";
    }

    protected function loadViewsFrom($path, $namespace)
    {
        if (is_array($this->app->config['view']['paths'])) {
            foreach ($this->app->config['view']['paths'] as $viewPath) {
                if (is_dir($appPath = $viewPath.'/vendor/'.$namespace)) {
                    $this->app['view']->addNamespace($namespace, $appPath);
                }
            }
        }

        $this->app['view']->addNamespace($namespace, $path);
    }

    private function loadViews()
    {
        $viewPath = __DIR__ . '/../resources/views';

        $this->loadViewsFrom($viewPath, 'radmin-users');

        $this->publishes([
            $viewPath => base_path('resources/views/vendor/radmin-users'),
        ], 'views');
    }

    public function menusidebar()
    {
        $configItems = config('radmin-users.menu-items');

        $submenu[] = [
            'text' => 'Manage',
            'url' => 'admin/users',
            'icon' => 'user',
            'priority' => 'medium-high',
            'dropped',
        ];

        foreach($configItems as $configItem)
        {
            $submenu[] = $configItem;
        }

        return [
            [
                'text' => 'Users',
                'url' => '#',
                'icon' => 'users',
                'submenu' => $submenu,
            ],
        ];
    }
}