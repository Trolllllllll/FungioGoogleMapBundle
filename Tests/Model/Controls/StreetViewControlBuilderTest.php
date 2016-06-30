<?php

/*
 * This file is part of the Fungio Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMapBundle\Tests\Model\Controls;

use Fungio\GoogleMap\Controls\ControlPosition;
use Fungio\GoogleMapBundle\Model\Controls\StreetViewControlBuilder;

/**
 * Street view control builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class StreetViewControlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMapBundle\Model\Controls\StreetViewControlBuilder */
    protected $streetViewControlBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->streetViewControlBuilder = new StreetViewControlBuilder('Fungio\GoogleMap\Controls\StreetViewControl');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->streetViewControlBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Fungio\GoogleMap\Controls\StreetViewControl', $this->streetViewControlBuilder->getClass());
        $this->assertNull($this->streetViewControlBuilder->getControlPosition());
    }

    public function testSingleBuildWithoutValues()
    {
        $streetViewControl = $this->streetViewControlBuilder->build();

        $this->assertSame(ControlPosition::TOP_LEFT, $streetViewControl->getControlPosition());
    }

    public function testSingleBuildWithValues()
    {
        $this->streetViewControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->streetViewControlBuilder->getControlPosition());

        $streetViewControl = $this->streetViewControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $streetViewControl->getControlPosition());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->streetViewControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $streetViewControl1 = $this->streetViewControlBuilder->build();
        $streetViewControl2 = $this->streetViewControlBuilder->build();

        $this->assertNotSame($streetViewControl1, $streetViewControl2);
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $streetViewControl1->getControlPosition());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $streetViewControl2->getControlPosition());
    }

    public function testMultipleBuildWithReset()
    {
        $this->streetViewControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $streetViewControl1 = $this->streetViewControlBuilder->build();
        $this->streetViewControlBuilder->reset();
        $streetViewControl2 = $this->streetViewControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $streetViewControl1->getControlPosition());
        $this->assertSame(ControlPosition::TOP_LEFT, $streetViewControl2->getControlPosition());
    }
}
