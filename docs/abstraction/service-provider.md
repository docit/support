<!---
title: ServiceProvider
subtitle: Abstraction
author: Robin Radic
-->

The service provider can be extended and will provide a high level of abstraction.
All properties and methods have docblock documentation explaining how and what for its used.

### Basic Example
Read the docblocks in the `Docit\Support\ServiceProvider` for more imformation.

```php
use Docit\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider {

    # Mandatory property to define the path to the directory. 
    # All other paths are relative to this and by default expects to be in the src directory
    protected $dir = __DIR__;

    # uses the $dir and $configPath to create the path and suffixes the my.package with .php 
    protected $configFiles = [ 'my.package' ];
    
    # Instead of using the provides() method, use this property
    protected $provides = [ 'beverage.generator', 'fs' ];
    
    public function boot(){
        # When overriding the boot method, make sure to call the super method.
        # returns the Application instance
        $app = parent::boot(); 
    }
        
    public function register(){
        # When overriding the register method, make sure to call the super method.
        # returns the Application instance
        $app = parent::register(); 
        
        $app->singleton('fs', Filesystem::class);
    }
}
```

### Implementation Example

An example that shows how [`caffeinated/themes`](https://github.com/caffeinated/themes/blob/v3/src/ThemeServiceProvider.php) has implemented the `ServiceProvider`

```php
namespace Docit\Themes;

use Illuminate\Foundation\Application;
use Illuminate\Contracts\View\View;
use Docit\Support\ServiceProvider;


class ThemeServiceProvider extends ServiceProvider
{
    protected $dir = __DIR__;

    protected $configFiles = ['caffeinated.themes'];

    protected $providers = [
        \Collective\Html\HtmlServiceProvider::class,
        \Docit\Themes\Providers\ConsoleServiceProvider::class
    ];

    protected $provides = ['caffeinated.themes'];

    public function register()
    {
        $app = parent::register();

        $this->registerThemes();
        $this->registerViewFinder();

        $app->make('events')->listen('creating: *', function (View $view) use ($app)
        {
            $app->make('caffeinated.themes')->boot();
        });
    }

    protected function registerThemes()
    {
        $this->app->singleton('caffeinated.themes', function (Application $app)
        {
            $themeFactory = new ThemeFactory($app->make('files'), $app->make('events'), $app->make('url'));
            $themeFactory->setPaths(config('caffeinated.themes.paths'));
            $themeFactory->setThemeClass(config('caffeinated.themes.themeClass'));
            $themeFactory->setActive(config('caffeinated.themes.active'));
            $themeFactory->setDefault(config('caffeinated.themes.default'));

            return $themeFactory;
        });
        $this->app->alias('caffeinated.themes', 'Docit\Themes\Contracts\ThemeFactory');
    }
}
```
