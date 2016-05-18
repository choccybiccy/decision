<?php

namespace Choccybiccy\Decision\Factor;

/**
 * Class SimilarityFactor.
 */
class SimilarityFactor implements FactorInterface
{
    /**
     * Regex pattern.
     * @var string
     */
    protected $value;

    /**
     * Factor weight.
     * @var int
     */
    protected $weight = 1;


    /**
     * SimilarityFactor constructor.
     * @param string $value
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
        if (!is_scalar($value) || !is_scalar($this->value)) {
            return 0;
        }
        if ($value == $this->value) {
            return 1 * $this->weight;
        }
        similar_text($value, $this->value, $percent);
        return ($percent/100) * $this->weight;
    }
}
