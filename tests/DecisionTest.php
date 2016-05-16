<?php

namespace Choccybiccy\Decision;

/**
 * Class DecisionTest.
 */
class DecisionTest extends TestCase
{
    /**
     * Test getResults() returns results.
     */
    public function testGetResults()
    {
        $decision = new Decision($this->getScores());
        $this->assertEquals($this->getScores(), $decision->getResults());
    }

    /**
     * Test getScores() returns scores for values
     */
    public function testGetScores()
    {
        $decision = new Decision($this->getScores());
        $this->assertEquals($this->getScoresTotalled(), $decision->getScores());
    }

    /**
     * Test getWinner returns winner
     */
    public function testGetWinner()
    {
        $decision = new Decision($this->getScores());
        $scores = array_flip($this->getScoresTotalled());
        $this->assertEquals(array_shift($scores), $decision->getWinner());
    }

    /**
     * Get some test results.
     *
     * @return array
     */
    protected function getScores()
    {
        return [
            'string1' => [
                ['score' => 1],
                ['score' => 1],
                ['score' => 2],
                ['score' => 3],
            ],
            'string2' => [
                ['score' => 2],
                ['score' => 1],
                ['score' => 5],
                ['score' => 4],
            ]
        ];
    }

    /**
     * @return array
     */
    protected function getScoresTotalled()
    {
        $scores = $this->getScores();
        $totals = [];
        foreach ($scores as $value => $results) {
            $totals[$value] = 0;
            foreach ($results as $score) {
                $totals[$value] += $score['score'];
            }
        }
        arsort($totals);
        return $totals;
    }
}
