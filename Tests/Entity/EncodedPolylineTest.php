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

use Fungio\GoogleMapBundle\Entity\EncodedPolyline;

/**
 * Encoded polyline test.
 *
 * @author GeLo <geloen.eric@gmail.com>
 */
class EncodedPolylineTest extends \PHPUnit_Framework_TestCase
{
    public function testInheritance()
    {
        $this->assertInstanceOf('Fungio\GoogleMap\Overlays\EncodedPolyline', new EncodedPolyline());
    }
}
