<?php

namespace Choccybiccy\Decision\Factor;

/**
 * Class IsFactor.
 */
class IsFactor implements FactorInterface
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
     * IsFactor constructor.
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
        if (is_scalar($value) && is_scalar($this->value) && $value == $this->value) {
            return 1 * $this->weight;
        }
        return 0;
    }
}
