<?php

/*
 * This file is part of the Fungio Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMapBundle\Model\Controls;

use Fungio\GoogleMapBundle\Model\AbstractBuilder;

/**
 * Street view control builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlBuilder extends AbstractBuilder
{
    /** @var string */
    protected $controlPosition;

    /**
     * Gets the control position.
     *
     * @return string The control position.
     */
    public function getControlPosition()
    {
        return $this->controlPosition;
    }

    /**
     * Sets the control position.
     *
     * @param string $controlPosition The control position.
     *
     * @return \Fungio\GoogleMapBundle\Model\Controls\StreetViewControlBuilder The builder.
     */
    public function setControlPosition($controlPosition)
    {
        $this->controlPosition = $controlPosition;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->controlPosition = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Fungio\GoogleMap\Controls\StreetViewControl The street view control.
     */
    public function build()
    {
        $streetViewControl = new $this->class();

        if ($this->controlPosition !== null) {
            $streetViewControl->setControlPosition($this->controlPosition);
        }

        return $streetViewControl;
    }
}
