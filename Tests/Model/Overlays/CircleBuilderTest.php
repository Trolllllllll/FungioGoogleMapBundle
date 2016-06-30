<?php

/*
 * This file is part of the Fungio Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMapBundle\Tests\Model\Overlays;

use Fungio\GoogleMapBundle\Model\Base\CoordinateBuilder;
use Fungio\GoogleMapBundle\Model\Overlays\CircleBuilder;

/**
 * Circle builder test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class CircleBuilderTest extends \PHPUnit_Framework_TestCase
{
    /** @var \Fungio\GoogleMapBundle\Model\Overlays\CircleBuilder */
    protected $circleBuilder;

    /** @var \Fungio\GoogleMapBundle\Model\Base\CoordinateBuilder */
    protected $coordinateBuilder;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        $this->coordinateBuilder = new CoordinateBuilder('Fungio\GoogleMap\Base\Coordinate');
        $this->circleBuilder = new CircleBuilder('Fungio\GoogleMap\Overlays\Circle', $this->coordinateBuilder);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        unset($this->circleBuilder);
        unset($this->coordinateBuilder);
    }

    public function testInitialState()
    {
        $this->assertSame('Fungio\GoogleMap\Overlays\Circle', $this->circleBuilder->getClass());
        $this->assertSame($this->coordinateBuilder, $this->circleBuilder->getCoordinateBuilder());
        $this->assertNull($this->circleBuilder->getPrefixJavascriptVariable());
        $this->assertEmpty($this->circleBuilder->getCenter());
        $this->assertNull($this->circleBuilder->getRadius());
        $this->assertEmpty($this->circleBuilder->getOptions());
    }

    public function testSingleBuildWithoutValues()
    {
        $circle = $this->circleBuilder->build();

        $this->assertSame('circle_', substr($circle->getJavascriptVariable(), 0, 7));

        $this->assertSame(0, $circle->getCenter()->getLatitude());
        $this->assertSame(0, $circle->getCenter()->getLongitude());
        $this->assertTrue($circle->getCenter()->isNoWrap());

        $this->assertSame(1, $circle->getRadius());
        $this->assertEmpty($circle->getOptions());
    }

    public function testSingleBuildWithValues()
    {
        $this->circleBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setCenter(1, 2, false)
            ->setRadius(2)
            ->setOptions(array('foo' => 'bar'));

        $this->assertSame('foo', $this->circleBuilder->getPrefixJavascriptVariable());
        $this->assertSame(array(1, 2, false), $this->circleBuilder->getCenter());
        $this->assertSame(2, $this->circleBuilder->getRadius());
        $this->assertSame(array('foo' => 'bar'), $this->circleBuilder->getOptions());

        $circle = $this->circleBuilder->build();

        $this->assertSame('foo', substr($circle->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $circle->getCenter()->getLatitude());
        $this->assertSame(2, $circle->getCenter()->getLongitude());
        $this->assertFalse($circle->getCenter()->isNoWrap());

        $this->assertSame(2, $circle->getRadius());
        $this->assertSame(array('foo' => 'bar'), $circle->getOptions());
    }

    public function testMultipleBuildWithoutReset()
    {
        $this->circleBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setCenter(1, 2, false)
            ->setRadius(2)
            ->setOptions(array('foo' => 'bar'));

        $circle1 = $this->circleBuilder->build();
        $circle2 = $this->circleBuilder->build();

        $this->assertNotSame($circle1, $circle2);

        $this->assertSame('foo', substr($circle1->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $circle1->getCenter()->getLatitude());
        $this->assertSame(2, $circle1->getCenter()->getLongitude());
        $this->assertFalse($circle1->getCenter()->isNoWrap());

        $this->assertSame(2, $circle1->getRadius());
        $this->assertSame(array('foo' => 'bar'), $circle1->getOptions());

        $this->assertSame('foo', substr($circle2->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $circle2->getCenter()->getLatitude());
        $this->assertSame(2, $circle2->getCenter()->getLongitude());
        $this->assertFalse($circle2->getCenter()->isNoWrap());

        $this->assertSame(2, $circle2->getRadius());
        $this->assertSame(array('foo' => 'bar'), $circle2->getOptions());
    }

    public function testMultipleBuildWithReset()
    {
        $this->circleBuilder
            ->setPrefixJavascriptVariable('foo')
            ->setCenter(1, 2, false)
            ->setRadius(2)
            ->setOptions(array('foo' => 'bar'));

        $circle1 = $this->circleBuilder->build();
        $this->circleBuilder->reset();
        $circle2 = $this->circleBuilder->build();

        $this->assertSame('foo', substr($circle1->getJavascriptVariable(), 0, 3));

        $this->assertSame(1, $circle1->getCenter()->getLatitude());
        $this->assertSame(2, $circle1->getCenter()->getLongitude());
        $this->assertFalse($circle1->getCenter()->isNoWrap());

        $this->assertSame(2, $circle1->getRadius());
        $this->assertSame(array('foo' => 'bar'), $circle1->getOptions());

        $this->assertSame('circle_', substr($circle2->getJavascriptVariable(), 0, 7));

        $this->assertSame(0, $circle2->getCenter()->getLatitude());
        $this->assertSame(0, $circle2->getCenter()->getLongitude());
        $this->assertTrue($circle2->getCenter()->isNoWrap());

        $this->assertSame(1, $circle2->getRadius());
        $this->assertEmpty($circle2->getOptions());
    }
}
