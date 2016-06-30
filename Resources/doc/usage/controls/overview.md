# Overview map control

The overview map control displays a thumbnail overview map reflecting the current map viewport within a wider area.
This control appears by default in the bottom right corner of the map, and is by default shown in its collapsed state.

## Build your overview map control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``fungio_google_map.overview_map_control`` service is. The configuration
describes below is this default configuration.

```yaml
# app/config/config.yml

fungio_google_map:
    overview_map_control:
        # You own overview map control class
        class: "My\Fucking\OverviewMapControl"

        # Your own overview map control helper
        helper_class: "My\Fucking\OverviewMapControlHelper"

        # TRUE if the overview map control is opened else FALSE
        opened: false
```

``` php
<?php

// Requests the fungio google map overview control service
$overviewMapControl = $this->get('fungio_google_map.overview_map_control');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/fungio/fungio-google-map/blob/master/doc/usage/controls/overview.md).
