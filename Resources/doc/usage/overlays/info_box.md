# Info box

Info box displays content in a floating window above the map. Basically, it is the same as an
[info window](http://github.com/fungio/FungioGoogleMapBundle/blob/master/Resources/doc/usage/overlays/info_window.md)
but through a different implementation. The Fungio Google Map library allows you to easily use this implementation by
simply replacing the info window helper & registering a new [extension helper](http://github.com/fungio/FungioGoogleMapBundle/blob/master/Resources/doc/usage/helper/extension.md).

So, on the map side, nothing change, you can still use an `InfoWindow`:

``` php

$map = $this->get('fungio_google_map.map');

$infoWindow = $this->get('fungio_google_map.info_window');
$infoWindow->setPosition(1.1, 2.1);

$map->addInfoWindow($infoWindow);
```

Now, to render the info window as info box, you need to replace the info window helper by the info box helper &
register the info box helper extension:

``` yaml
fungio_google_map:
    info_window:
        helper_class: Fungio\GoogleMap\Helper\Overlays\InfoBoxHelper
    extensions:
        info_box: fungio_google_map.helper.extension.info_box
```

Then, when you will render a map, the info window will be rendered as info box.
