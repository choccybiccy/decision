<?php

namespace Choccybiccy\Decision\Factor;

/**
 * Class OccurenceFactor.
 */
class OccurenceFactor implements FactorInterface
{
    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var int
     */
    protected $weight = 1;

    /**
     * OccurenceFactor constructor.
     * @param mixed $value
     * @param int $weight
     */
    public function __construct($value, $weight = 1)
    {
        $this->value = $value;
        $this->weight = $weight;
    }

    /**
     * {@inheritdoc}
     */
    public function score($value)
    {
        return substr_count(strtolower($value), strtolower($this->value)) * $this->weight;
    }
}
