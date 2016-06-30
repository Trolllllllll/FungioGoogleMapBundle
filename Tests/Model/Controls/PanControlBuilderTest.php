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
use Fungio\GoogleMapBundle\Model\Controls\PanControlBuilder;

/**
 * Pan control builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class PanControlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMapBundle\Model\Controls\PanControlBuilder */
    protected $panControlBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->panControlBuilder = new PanControlBuilder('Fungio\GoogleMap\Controls\PanControl');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->panControlBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Fungio\GoogleMap\Controls\PanControl', $this->panControlBuilder->getClass());
        $this->assertNull($this->panControlBuilder->getControlPosition());
    }

    public function testSingleBuildWithoutValues()
    {
        $panControl = $this->panControlBuilder->build();

        $this->assertSame(ControlPosition::TOP_LEFT, $panControl->getControlPosition());
    }

    public function testSingleBuildWithValues()
    {
        $this->panControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $this->panControlBuilder->getControlPosition());

        $panControl = $this->panControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $panControl->getControlPosition());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->panControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $panControl1 = $this->panControlBuilder->build();
        $panControl2 = $this->panControlBuilder->build();

        $this->assertNotSame($panControl1, $panControl2);
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $panControl1->getControlPosition());
        $this->assertSame(ControlPosition::BOTTOM_CENTER, $panControl2->getControlPosition());
    }

    public function testMultipleBuildWithReset()
    {
        $this->panControlBuilder->setControlPosition(ControlPosition::BOTTOM_CENTER);

        $panControl1 = $this->panControlBuilder->build();
        $this->panControlBuilder->reset();
        $panControl2 = $this->panControlBuilder->build();

        $this->assertSame(ControlPosition::BOTTOM_CENTER, $panControl1->getControlPosition());
        $this->assertSame(ControlPosition::TOP_LEFT, $panControl2->getControlPosition());
    }
}
