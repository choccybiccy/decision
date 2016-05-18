<?php

namespace Choccybiccy\Decision\Factor;

/**
 * Class ComparisonFactor.
 */
class ComparisonFactor implements FactorInterface
{
    const EQUAL = '==';
    const IDENTICAL = '===';
    const NOT_EQUAL = '!=';
    const NOT_EQUAL_ALT = '<>';
    const NOT_IDENTICAL = '!==';
    const GREATER_THAN = '>';
    const LESS_THAN = '<';
    const GREATER_THAN_OR_EQUAL_TO = '>=';
    const LESS_THAN_OR_EQUAL_TO = '<=';

    /**
     * @var mixed
     */
    protected $value;

    /**
     * @var string
     */
    protected $operator;

    /**
     * @var array
     */
    protected $allowedOperators = [
        self::EQUAL,
        self::IDENTICAL,
        self::NOT_EQUAL,
        self::NOT_EQUAL_ALT,
        self::NOT_IDENTICAL,
        self::GREATER_THAN,
        self::LESS_THAN,
        self::GREATER_THAN_OR_EQUAL_TO,
        self::LESS_THAN_OR_EQUAL_TO,
    ];

    /**
     * @var int
     */
    protected $weight = 1;

    /**
     * ArithmeticFactor constructor.
     * @param mixed $value
     * @param string $operator
     * @param int|float $weight
     *
     * @throws \InvalidArgumentException
     */
    public function __construct($value, $operator, $weight = 1)
    {
        if (!in_array($operator, $this->allowedOperators)) {
            throw new \InvalidArgumentException('Operator ' . $operator . ' is not supported (allowed: '
                . implode(', ', $this->allowedOperators));
        }
        $this->value = $value;
        $this->operator = $operator;
        $this->weight = (float) $weight;
    }

    /**
     * {@inheritdoc}
     */
    public function score($value)
    {
        $return = 0;
        switch ($this->operator) {
            case self::EQUAL:
                $return = $value == $this->value ? $this->weight : 0;
                break;
            case self::IDENTICAL:
                $return = $value === $this->value ? $this->weight : 0;
                break;
            case self::NOT_EQUAL:
            case self::NOT_EQUAL_ALT:
                $return = $value != $this->value ? $this->weight : 0;
                break;
            case self::NOT_IDENTICAL:
                $return = $value !== $this->value ? $this->weight : 0;
                break;
            case self::GREATER_THAN:
                $return = $value > $this->value ? $this->weight : 0;
                break;
            case self::LESS_THAN:
                $return = $value < $this->value ? $this->weight : 0;
                break;
            case self::GREATER_THAN_OR_EQUAL_TO:
                $return = $value >= $this->value ? $this->weight : 0;
                break;
            case self::LESS_THAN_OR_EQUAL_TO:
                $return = $value <= $this->value ? $this->weight : 0;
                break;
        }
        return $return;
    }
}
