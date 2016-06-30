<?php

/*
 * This file is part of the Fungio Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMapBundle\Model\Layers;

use Fungio\GoogleMapBundle\Model\AbstractBuilder;

/**
 * KML layer builder.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class KMLLayerBuilder extends AbstractBuilder
{
    /** @var string */
    protected $prefixJavascriptVariable;

    /** @var string */
    protected $url;

    /** @var array */
    protected $options;

    /**
     * {@inheritdoc}
     */
    public function __construct($class)
    {
        parent::__construct($class);

        $this->reset();
    }

    /**
     * Gets the javascript variable.
     *
     * @return string The javascript variable.
     */
    public function getPrefixJavascriptVariable()
    {
        return $this->prefixJavascriptVariable;
    }

    /**
     * Sets the javascript variable.
     *
     * @param string $prefixJavascriptVariable The javascript variable.
     *
     * @return \Fungio\GoogleMapBundle\Model\Layers\KMLLayerBuilder The builder.
     */
    public function setPrefixJavascriptVariable($prefixJavascriptVariable)
    {
        $this->prefixJavascriptVariable = $prefixJavascriptVariable;

        return $this;
    }

    /**
     * Gets the KML layer url.
     *
     * @return string The KML layer url.
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Sets the KML layer url.
     *
     * @param string $url The KML layer url.
     *
     * @return \Fungio\GoogleMapBundle\Model\Layers\KMLLayerBuilder The builder.
     */
    public function setUrl($url)
    {
        $this->url = $url;

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
     * @return \Fungio\GoogleMapBundle\Model\Layers\KMLLayerBuilder The builder.
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
        $this->prefixJavascriptVariable = null;
        $this->url = null;
        $this->options = array();

        return $this;
    }

    /**
     * {@inheritdoc}
     *
     * @return \Fungio\GoogleMap\Layers\KMLLayer The kml layer.
     */
    public function build()
    {
        $kmlLayer = new $this->class();

        if ($this->prefixJavascriptVariable !== null) {
            $kmlLayer->setPrefixJavascriptVariable($this->prefixJavascriptVariable);
        }

        if ($this->url !== null) {
            $kmlLayer->setUrl($this->url);
        }

        if (!empty($this->options)) {
            $kmlLayer->setOptions($this->options);
        }

        return $kmlLayer;
    }
}
