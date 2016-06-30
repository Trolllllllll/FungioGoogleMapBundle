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
 * Pan control builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlBuilder extends AbstractBuilder
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
     */
    public function setControlPosition($controlPosition)
    {
        $this->controlPosition = $controlPosition;
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
     * @return \Fungio\GoogleMap\Controls\PanControl The pan control.
     */
    public function build()
    {
        $panControl = new $this->class();

        if ($this->controlPosition !== null) {
            $panControl->setControlPosition($this->controlPosition);
        }

        return $panControl;
    }
}
