<?php

namespace Choccybiccy\Decision\Factor;

/**
 * Class RegexFactor.
 */
class RegexFactor implements FactorInterface
{
    /**
     * Regex pattern.
     * @var string
     */
    protected $pattern;

    /**
     * Factor weight.
     * @var int
     */
    protected $weight = 1;

    /**
     * RegexFactor constructor.
     * @param string $pattern
     * @param int $weight
     */
    public function __construct($pattern, $weight = 1)
    {
        $this->pattern = $pattern;
        $this->weight = $weight;
    }

    /**
     * {@inheritdoc}
     */
    public function score($value)
    {
        if (is_scalar($value) && is_scalar($this->pattern) && preg_match($this->pattern, $value)) {
            return 1 * $this->weight;
        }
        return 0;
    }
}
