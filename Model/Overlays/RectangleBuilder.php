<?php

/*
 * This file is part of the Fungio Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMapBundle\Model\Overlays;

use Fungio\GoogleMapBundle\Model\AbstractBuilder;
use Fungio\GoogleMapBundle\Model\Base\BoundBuilder;

/**
 * Rectangle builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class RectangleBuilder extends AbstractBuilder
{
    /** @var \Fungio\GoogleMapBundle\Model\Base\BoundBuilder */
    protected $boundBuilder;

    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var array */
    protected $bound;

    /** @var array */
    protected $options;

    /**
     * Creates a rectangle builder.
     *
     * @param string                                         $class        The class to build.
     * @param \Fungio\GoogleMapBundle\Model\Base\BoundBuilder $boundBuilder The bound builder.
     */
    public function __construct($class, BoundBuilder $boundBuilder)
    {
        parent::__construct($class);

        $this->setBoundBuilder($boundBuilder);
        $this->reset();
    }

    /**
     * Gets the bound builder.
     *
     * @return \Fungio\GoogleMapBundle\Model\Base\BoundBuilder The bound builder.
     */
    public function getBoundBuilder()
    {
        return $this->boundBuilder;
    }

    /**
     * Sets the bound builder.
     *
     * @param \Fungio\GoogleMapBundle\Model\Base\BoundBuilder $boundBuilder The bound builder.
     *
     * @return \Fungio\GoogleMapBundle\Model\Overlays\RectangleBuilder The builder.
     */
    public function setBoundBuilder(BoundBuilder $boundBuilder)
    {
        $this->boundBuilder = $boundBuilder;

        return $this;
    }

    /**
     * Gets the prefix javascript variable.
     *
     * @return strign The prefix javascript variable.
     */
    public function getPrefixJavascriptVariable()
    {
        return $this->prefixJavascriptVariable;
    }

    /**
     * Sets the prefix javascript variable.
     *
     * @param string $prefixJavascriptVariable The prefix javascript variable.
     *
     * @return \Fungio\GoogleMapBundle\Model\Overlays\RectangleBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the bound.
     *
     * @return array The bound.
     */
    public function getBound()
    {
        return $this->bound;
    }

    /**
     * Sets the bound.
     *
     * @param double  $southWestLatitude  The south west latitude.
     * @param double  $southWestLongitude The south west longitude.
     * @param double  $northEastLatitude  The south west no wrap.
     * @param double  $northEastLongitude The north east latitude.
     * @param boolean $southWestNoWrap    The north east longitude.
     * @param boolean $northEastNoWrap    The north east no wrap.
     *
     * @return \Fungio\GoogleMapBundle\Model\Overlays\RectangleBuilder The builder.
     */
    public function setBound(
        $southWestLatitude,
        $southWestLongitude,
        $northEastLatitude,
        $northEastLongitude,
        $southWestNoWrap = true,
        $northEastNoWrap = true
    ) {
        $this->bound = array(
            $southWestLatitude,
            $southWestLongitude,
            $southWestNoWrap,
            $northEastLatitude,
            $northEastLongitude,
            $northEastNoWrap,
        );

        return $this;
    }

    /**
     * Gets the options.
     *
     * @return array The options.
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Sets the options.
     *
     * @param array $options The options.
     *
     * @return \Fungio\GoogleMapBundle\Model\Overlays\RectangleBuilder The builder.
     */
    public function setOptions(array $options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function reset()
    {
        $this->boundBuilder->reset();

        $this->prefixJavascriptVariable = null;
        $this->bound = array();
        $this->options = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Fungio\GoogleMap\Overlays\Rectangle The reclangle.
     */
    public function build()
    {
        $rectangle = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $rectangle->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if (!empty($this->bound)) {
            $bound = $this->boundBuilder
                ->reset()
                ->setSouthWest($this->bound[0], $this->bound[1], $this->bound[2])
                ->setNorthEast($this->bound[3], $this->bound[4], $this->bound[5])
                ->build();

            $rectangle->setBound($bound);
        }

        if (!empty($this->options)) {
            $rectangle->setOptions($this->options);
        }

        return $rectangle;
    }
}
