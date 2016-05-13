<?php

namespace Choccybiccy\Decision;

use Choccybiccy\Decision\Factor\FactorInterface;
use Choccybiccy\Decision\Factor\LevenshteinFactor;
use Choccybiccy\Decision\Factor\OccurenceFactor;
use Choccybiccy\Decision\Factor\SimilarityFactor;

/**
 * Class EngineTest.
 */
class EngineTest extends TestCase
{

    /**
     * Test add/set factors works.
     */
    public function testAddSetFactors()
    {
        $engine = new Engine();
        $factor = $this->getMockFactor();
        $this->assertEquals([], $engine->getFactors());
        $engine->addFactor($factor);
        $this->assertEquals([$factor], $engine->getFactors());
        $engine->setFactors([]);
        $this->assertEquals([], $engine->getFactors());
        $engine->setFactors([$factor, $factor]);
        $this->assertEquals([$factor, $factor], $engine->getFactors());
    }

    /**
     * Test decide runs the processFactors sub-routine.
     */
    public function testDecide()
    {
        $engine = $this->getMockEngine(['processFactors'], [1, 2], [$this->getMockFactor()]);
        $engine->expects($this->at(0))
            ->method('processFactors')
            ->with(1);
        $engine->expects($this->at(1))
            ->method('processFactors')
            ->with(2);
        $engine->decide();
    }

    /**
     * Test processFactors runs factors on a value
     */
    public function testProcessFactors()
    {
        $factor = $this->getMockFactor(['score']);
        $factor->expects($this->once())
            ->method('score')
            ->with(1);
        $engine = $this->getMockEngine([], [], [$factor]);
        $this->runProtectedMethod($engine, 'processFactors', [1]);
    }

    /**
     * Quick and dirty functional test.
     */
    public function testFunctional()
    {
        $value1 = 'This is not spam.';
        $value2 = 'Spammy spam spam spam!';
        $engine = new Engine([$value1, $value2], [
            new OccurenceFactor('spam')
        ]);
        $decision = $engine->decide();
        $winner = $decision->getWinner();
        $this->assertEquals($value2, $winner);
    }

    /**
     * @param array $methods
     * @param array $values
     * @param FactorInterface[] $factors
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockEngine($methods = [], $values = [], $factors = [])
    {
        return $this->getMockBuilder('Choccybiccy\Decision\Engine')
            ->setConstructorArgs([$values, $factors])
            ->setMethods($methods)
            ->getMock();
    }

    /**
     * @param array $methods
     *
     * @return \PHPUnit_Framework_MockObject_MockObject
     */
    protected function getMockFactor($methods = [])
    {
        return $this->getMock('Choccybiccy\Decision\Factor\FactorInterface', $methods);
    }
}
