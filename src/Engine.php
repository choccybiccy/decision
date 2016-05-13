<?php

namespace Choccybiccy\Decision;

use Choccybiccy\Decision\Factor\FactorInterface;

/**
 * Class Engine.
 */
class Engine implements EngineInterface
{
    /**
     * @var array
     */
    protected $values;

    /**
     * @var FactorInterface[]
     */
    protected $factors;
    
    /**
     * Engine constructor.
     * @param array $values
     * @param FactorInterface[] $factors
     */
    public function __construct(array $values = [], array $factors = [])
    {
        $this->values = $values;
        $this->factors = $factors;
    }

    /**
     * Add a factor.
     *
     * @param FactorInterface $factor
     *
     * @return $this
     */
    public function addFactor(FactorInterface $factor)
    {
        $this->factors[] = $factor;
        return $this;
    }

    /**
     * Set factors.
     *
     * @param FactorInterface[] $factors
     *
     * @return $this
     */
    public function setFactors(array $factors)
    {
        $this->factors = [];
        foreach ($factors as $factor) {
            $this->addFactor($factor);
        }
        return $this;
    }

    /**
     * @return Factor\FactorInterface[]
     */
    public function getFactors()
    {
        return $this->factors;
    }

    /**
     * {@inheritdoc}
     */
    public function decide()
    {
        $results = [];
        foreach ($this->values as $value) {
            $results[$value] = $this->processFactors($value);
        }
        return new Decision($results);
    }

    /**
     * Process factors on a given value.
     *
     * @param mixed $value
     *
     * @return array
     */
    protected function processFactors($value)
    {
        $results = [];
        foreach ($this->factors as $factor) {
            $results[] = [
                'score' => $factor->score($value),
                'factor' => $factor,
            ];
        }
        return $results;
    }
}
