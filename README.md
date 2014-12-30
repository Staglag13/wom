<h1>wom</h1>

<h3>Install</h3>

Add bundle to composer.json

```json
"require": {
    ...
    "staglag13/wom-test-bundle": "*"
},
```
    
Update via composer

    $ composer update staglag13/wom-test-bundle

Register bundle in app/AppKernel.php

````php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Staglag13\WomTestBundle\Staglag13WomTestBundle(),
        );

        ...
    }
}
```
    
Add routing to app/config/routing.yml
    
```yaml
staglag13_wom_test:
    resource: "@Staglag13WomTestBundle/Resources/config/routing.yml"
    prefix:   /
```

<h3>Run</h3>

<h5>Webbrowser</h5>

Start Demo in Browser with URL: 
    
    http://localhost:8000/app_dev.php/musicmoz

<h5>Command</h5>

Run Demo via shell execute: 

    php app/console musicmoz:run

<h3>Testing</h3>

Start the PHPUnit Test via shell command:

    phpunit -c app/ vendor/staglag13/wom-test-bundle/Staglag13/WomTestBundle/
