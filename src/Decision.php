<?php

namespace Choccybiccy\Decision;

/**
 * Class Decision.
 */
class Decision
{
    /**
     * @var array
     */
    protected $results = [];

    /**
     * Decision constructor.
     * @param array $results
     */
    public function __construct(array $results)
    {
        $this->results = $results;
    }

    /**
     * Get decision results.
     *
     * @return array
     */
    public function getResults()
    {
        return $this->results;
    }

    /**
     * @return array
     */
    public function getScores()
    {
        $valueTotals = [];
        foreach ($this->results as $value => $results) {
            $valueTotals[$value] = $this->calculateScores($results);
        }
        arsort($valueTotals);
        return $valueTotals;
    }

    /**
     * Get the winning value.
     *
     * @return mixed
     */
    public function getWinner()
    {
        $scores = $this->getScores();
        return array_shift(array_flip($scores));
    }

    /**
     * Calculate total from all scores.
     *
     * @param array $scores
     *
     * @return float
     */
    protected function calculateScores(array $scores)
    {
        $total = 0;
        foreach ($scores as $score) {
            $total += $score['score'];
        }
        return $total;
    }
}
