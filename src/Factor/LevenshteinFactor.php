<?php

namespace Choccybiccy\Decision\Factor;

/**
 * Class LevenshteinFactor.
 */
class LevenshteinFactor implements FactorInterface
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
            $result = 1;
        } else {
            $levenshtein = levenshtein($this->value, $value);
            $result = 1 - ($levenshtein/strlen($value));
        }
        return $result * $this->weight;
    }
}
