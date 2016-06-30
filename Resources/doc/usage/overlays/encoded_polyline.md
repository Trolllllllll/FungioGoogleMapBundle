# Encoded Polyline

The Encoded Polyline class defines a [Polyline](http://github.com/fungio/FungioGoogleMapBundle/blob/master/Resources/doc/usage/overlays/polyline.md)
which has been encoded using the algorithm described [here](http://code.google.com/apis/maps/documentation/utilities/polylinealgorithm.html).

## Build your encoded polyline

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``fungio_google_map.encoded_polyline`` service is. The configuration
describes below is this default configuration.

```yaml
# app/config/config.yml

fungio_google_map
    encoded_polyline:
        # Your own encoded polyline class
        class: "My\Fucking\EncodedPolyline"

        # Your own encoded polyline helper class
        helper_class: "My\Fucking\EncodedPolylineHelper"

        # Prefix used for the generation of the encoded polyline javascript variable
        prefix_javascript_variable: "encoded_polyline_"

        # Custom encoded polyline options
        # All polyline options are available
        # By default, there is no options
        options:
            geodesic: true
            strokeColor: "#ffffff"
```

``` php
<?php

// Requests the fungio google map encoded polyline service
$encodedPolyline = $this->get('fungio_google_map.encoded_polyline');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/fungio/fungio-google-map/blob/master/doc/usage/overlays/encoded_polyline.md).
