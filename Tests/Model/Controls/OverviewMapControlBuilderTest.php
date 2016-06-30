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

use Fungio\GoogleMapBundle\Model\Controls\OverviewMapControlBuilder;

/**
 * Overview map control builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMapBundle\Model\Controls\OverviewMapControlBuilder */
    protected $overviewMapControlBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->overviewMapControlBuilder = new OverviewMapControlBuilder('Fungio\GoogleMap\Controls\OverviewMapControl');
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->overviewMapControlBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Fungio\GoogleMap\Controls\OverviewMapControl', $this->overviewMapControlBuilder->getClass());
        $this->assertNull($this->overviewMapControlBuilder->isOpened());
    }

    public function testSingleBuildWithoutValues()
    {
        $overviewMapControl = $this->overviewMapControlBuilder->build();

        $this->assertFalse($overviewMapControl->isOpened());
    }

    public function testSingleBuildWithValues()
    {
        $this->overviewMapControlBuilder->setOpened(true);

        $this->assertTrue($this->overviewMapControlBuilder->isOpened());

        $overviewMapControl = $this->overviewMapControlBuilder->build();

        $this->assertTrue($overviewMapControl->isOpened());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->overviewMapControlBuilder->setOpened(true);

        $overviewMapControl1 = $this->overviewMapControlBuilder->build();
        $overviewMapControl2 = $this->overviewMapControlBuilder->build();

        $this->assertNotSame($overviewMapControl1, $overviewMapControl2);
        $this->assertTrue($overviewMapControl1->isOpened());
        $this->assertTrue($overviewMapControl2->isOpened());
    }

    public function testMultipleBuildWithReset()
    {
        $this->overviewMapControlBuilder->setOpened(true);

        $overviewMapControl1 = $this->overviewMapControlBuilder->build();
        $this->overviewMapControlBuilder->reset();
        $overviewMapControl2 = $this->overviewMapControlBuilder->build();

        $this->assertTrue($overviewMapControl1->isOpened());
        $this->assertFalse($overviewMapControl2->isOpened());
    }
}
