# Installation

## Symfony >= 2.1

Require the bundle in your composer.json file:

```sh
composer require fungio/google-map-bundle: ~2.1
```

If you want to use Geocoding stuff, you will need [Geocoder](http://github.com/willdurand/Geocoder):

```sh
composer require willdurand/geocoder
```

If you want to use Directions or Distance Matrix stuff, you will need an [http adapter](http://github.com/widop/WidopHttpAdapterBundle):

```sh
composer require widop/http-adapter-bundle
```

Register the bundle:

If you use Directions or Distance Matrix stuff, don't forget to register the Wid'op http adapter bundle too.

``` php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        new Fungio\GoogleMapBundle\FungioGoogleMapBundle(),
        // ...
    );
}
```

Install the bundle:

```
$ composer update
```

## Symfony 2.0.*

Add Fungio Google Map bundle & library to your deps file:

```
[FungioGoogleMapBundle]
    git=http://github.com/fungio/FungioGoogleMapBundle.git
    target=bundles/Fungio/GoogleMapBundle
    version=2.0.3

[fungio-google-map]
    git=http://github.com/fungio/fungio-google-map.git
```

Autoload the Fungio Google Map bundle & library namespaces:

``` php
// app/autoload.php

$loader->registerNamespaces(array(
    'Fungio\\GoogleMap'       => __DIR__.'/../vendor/fungio-google-map/src',
    'Fungio\\GoogleMapBundle' => __DIR__.'/../vendor/bundles',
    // ...
);
```

If you want to use Geocoding stuff, you will need [Geocoder](http://github.com/willdurand/Geocoder):

```
[geocoder]
    git=http://github.com/willdurand/Geocoder.git
```

``` php
// app/autoload.php

$loader->registerNamespaces(array(
    'Geocoder' => __DIR__.'/../vendor/geocoder/src',
    // ...
);
```

If you want to use Directions or Distance Matrix stuff, you will need an [http adapter](http://github.com/widop/WidopHttpAdapterBundle):

```
[http-adapter]
    git=http://github.com/widop/http-adapter.git
    version=1.0.2

[http-adapter-bundle]
    git=http://github.com/widop/WidopHttpAdapterBundle.git
    target=bundles/Widop/HttpAdapterBundle
    version=1.1.0
```

``` php
// app/autoload.php

$loader->registerNamespaces(array(
    'Widop\\HttpAdapter' => __DIR__.'/../vendor/http-adapter/src',
    // ...
);
```

Register the bundle:

``` php
// app/AppKernel.php

public function registerBundles()
{
    return array(
        new Fungio\GoogleMapBundle\FungioGoogleMapBundle(),
        // ...
    );
}
```

Run the vendors script:

``` bash
$ php bin/vendors install
```

Be aware that the Symfony 2.0 version of this bundle is no longer maintained.
