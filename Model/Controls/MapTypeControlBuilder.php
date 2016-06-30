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
 * Map type control builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class MapTypeControlBuilder extends AbstractBuilder
{
    /** @var array */
    protected $mapTypeIds;

    /** @var string */
    protected $controlPosition;

    /** @var string */
    protected $mapTypeControlStyle;

    /**
     * {@inheritdoc}
     */
    public function __construct($class)
    {
        parent::__construct($class);

        $this->reset();
    }

    /**
     * Gets the map types IDs.
     *
     * @return array The map types IDs.
     */
    public function getMapTypeIds()
    {
        return $this->mapTypeIds;
    }

    /**
     * Sets the map types IDs.
     *
     * @param array $mapTypeIds The map types IDs.
     *
     * @return \Fungio\GoogleMapBundle\Model\Controls\MapTypeControlBuilder The builder.
     */
    public function setMapTypeIds(array $mapTypeIds)
    {
        $this->mapTypeIds = $mapTypeIds;

        return $this;
    }

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
     * @return \Fungio\GoogleMapBundle\Model\Controls\MapTypeControlBuilder The builder.
     */
    public function setControlPosition($controlPosition)
    {
        $this->controlPosition = $controlPosition;

        return $this;
    }

    /**
     * Gets the map type control style.
     *
     * @return string The map type control style.
     */
    public function getMapTypeControlStyle()
    {
        return $this->mapTypeControlStyle;
    }

    /**
     * Sets the map type control style.
     *
     * @param string $mapTypeControlStyle The map type control style.
     *
     * @return \Fungio\GoogleMapBundle\Model\Controls\MapTypeControlBuilder The builder.
     */
    public function setMapTypeControlStyle($mapTypeControlStyle)
    {
        $this->mapTypeControlStyle = $mapTypeControlStyle;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->mapTypeIds = array();
        $this->controlPosition = null;
        $this->mapTypeControlStyle = null;

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Fungio\GoogleMap\Controls\MapTypeControl The map type control.
     */
    public function build()
    {
        $mapTypeControl = new $this->class();

        if (!empty($this->mapTypeIds)) {
            $mapTypeControl->setMapTypeIds($this->mapTypeIds);
        }

        if ($this->controlPosition !== null) {
            $mapTypeControl->setControlPosition($this->controlPosition);
        }

        if ($this->mapTypeControlStyle !== null) {
            $mapTypeControl->setMapTypeControlStyle($this->mapTypeControlStyle);
        }

        return $mapTypeControl;
    }
}
