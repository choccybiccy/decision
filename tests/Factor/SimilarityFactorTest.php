<?php

namespace Choccybiccy\Decision\Factor;

use Choccybiccy\Decision\TestCase;

/**
 * Class SimilarityFactorTest.
 */
class SimilarityFactorTest extends TestCase
{
    /**
     * Test score works as expected
     */
    public function testScore()
    {
        $factor = new SimilarityFactor('farm');
        similar_text('farm', 'form', $percent);
        $this->assertEquals($percent/100, $factor->score('form'));
    }

    /**
     * Test score() returns zero if not scalar
     */
    public function testScoreReturnsZeroIfNotScalar()
    {
        $factor = new SimilarityFactor(array());
        $this->assertEquals(0, $factor->score(1));
    }

    /**
     * Test score() returns 1 if they're the same
     */
    public function testScoreReturnsOneIfSame()
    {
        $factor = new SimilarityFactor('test');
        $this->assertEquals(1, $factor->score('test'));
    }
}
