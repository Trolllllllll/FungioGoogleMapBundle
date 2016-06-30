# Rotate control

The Rotate control contains a small circular icon which allows you to rotate maps containing oblique imagery. This
control appears by default in the top left corner of the map.

## Build your rotate control

### By configuration file

By default, the bundle doesn't need any configuration. Most of the service have a default configuration which allows
you to use the given objects like they are. The ``fungio_google_map.rotate_control`` service is. The configuration
describes below is this default configuration.

```yaml
# app/config/config.yml

fungio_google_map:
    rotate_control:
        # You own rotate control class
        class: "My\Fucking\RotateControl"

        # Your own rotate control helper
        helper_class: "My\Fucking\RotateControlHelper"

        # Rotate control position
        # Available rotate control position:
        # - top_left, top_center, top_right
        # - left_top, left_center, left_bottom
        # - right_top, right_center, right_bottom
        # - bottom_left, bottom_center, bottom_right
        control_position: top_left
```

``` php
<?php

// Requests the fungio google map rotate control service
$rotateControl = $this->get('fungio_google_map.rotate_control');
```

### By coding

If you want to learn more, you can read
[this documentation](https://github.com/fungio/fungio-google-map/blob/master/doc/usage/controls/rotate.md).
