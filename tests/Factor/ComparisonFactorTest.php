<?php

namespace Choccybiccy\Decision\Factor;

use Choccybiccy\Decision\TestCase;

/**
 * Class ComparisonFactorTest.
 */
class ComparisonFactorTest extends TestCase
{
    /**
     * Test score works as expected
     */
    public function testScore()
    {
        $value = mt_rand(1, 100);
        $comparisonValue = mt_rand(1, 100);
        $expected = [
            ComparisonFactor::EQUAL => ($value == $comparisonValue),
            ComparisonFactor::IDENTICAL => ($value === $comparisonValue),
            ComparisonFactor::NOT_EQUAL => ($value != $comparisonValue),
            ComparisonFactor::NOT_EQUAL_ALT => ($value <> $comparisonValue),
            ComparisonFactor::NOT_IDENTICAL => ($value !== $comparisonValue),
            ComparisonFactor::GREATER_THAN => ($value > $comparisonValue),
            ComparisonFactor::GREATER_THAN_OR_EQUAL_TO => ($value >= $comparisonValue),
            ComparisonFactor::LESS_THAN => ($value < $comparisonValue),
            ComparisonFactor::LESS_THAN_OR_EQUAL_TO => ($value <= $comparisonValue),
        ];
        foreach ($expected as $operator => $result) {
            $factor = new ComparisonFactor($comparisonValue, $operator);
            $this->assertEquals($result, $factor->score($value));
        }
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructThrowsExceptionForUnsupportedOperator()
    {
        $factor = new ComparisonFactor(1, 'UnknownOperator');
    }
}
