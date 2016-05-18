<?php

namespace Choccybiccy\Decision\Factor;

use Choccybiccy\Decision\TestCase;

/**
 * Class IsFactorTest.
 */
class RegexFactorTest extends TestCase
{
    /**
     * Test score works as expected
     */
    public function testScore()
    {
        $factor = new IsFactor(1);
        $this->assertEquals(1, $factor->score(1));
        $this->assertEquals(0, $factor->score(2));

        $factor = new IsFactor(1, 5);
        $this->assertEquals(5, $factor->score(1));
    }
}
