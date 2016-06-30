<?php

/*
 * This file is part of the Fungio Google Map bundle package.
 *
 * (c) Eric GELOEN <geloen.eric@gmail.com>
 *
 * For the full copyright and license information, please read the LICENSE
 * file that was distributed with this source code.
 */

namespace Fungio\GoogleMapBundle\Tests\Entity;

use Fungio\GoogleMapBundle\Entity\OverviewMapControl;

/**
 * Overview map control entity test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class OverviewMapControlTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $this->assertInstanceOf('Fungio\GoogleMap\Controls\OverviewMapControl', new OverviewMapControl());
    }
}
