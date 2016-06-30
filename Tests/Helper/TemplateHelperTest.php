<?php

/*
 * This file is part of the Fungio Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMapBundle\Tests\Helper;

use Fungio\GoogleMapBundle\Helper\TemplateHelper;

/**
 * Template helper test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class TemplateHelperTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMapBundle\Helper\TemplateHelper */
    protected $templateHelper;

    /** @var \Fungio\GoogleMap\Helper\MapHelper */
    protected $mapHelperMock;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->mapHelperMock = $this->getMock('Fungio\GoogleMap\Helper\MapHelper');
        $this->templateHelper = new TemplateHelper($this->mapHelperMock);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->templateHelper);
        unset($this->mapHelperMock);
    }

    public function testInitialState()
    {
        $this->assertInstanceOf('Symfony\Component\Templating\Helper\Helper', $this->templateHelper);
        $this->assertSame('fungio_google_map', $this->templateHelper->getName());
    }

    public function testRenderMap()
    {
        $map = $this->getMock('Fungio\GoogleMap\Map');

        $this->mapHelperMock
            ->expects($this->once())
            ->method('render')
            ->with($map)
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->templateHelper->renderMap($map));
    }

    public function testRenderHtmlContainer()
    {
        $map = $this->getMock('Fungio\GoogleMap\Map');

        $this->mapHelperMock
            ->expects($this->once())
            ->method('renderHtmlContainer')
            ->with($map)
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->templateHelper->renderHtmlContainer($map));
    }

    public function testRenderStylesheets()
    {
        $map = $this->getMock('Fungio\GoogleMap\Map');

        $this->mapHelperMock
            ->expects($this->once())
            ->method('renderStylesheets')
            ->with($map)
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->templateHelper->renderStylesheets($map));
    }

    public function testRenderJavascripts()
    {
        $map = $this->getMock('Fungio\GoogleMap\Map');

        $this->mapHelperMock
            ->expects($this->once())
            ->method('renderJavascripts')
            ->with($map)
            ->will($this->returnValue('foo'));

        $this->assertSame('foo', $this->templateHelper->renderJavascripts($map));
    }
}
