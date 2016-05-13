<?php

namespace Choccybiccy\Decision\Factor;

/**
 * Interface FactorInterface.
 */
interface FactorInterface
{
    /**
     * @param mixed $value
     * @return int|float
     */
    public function score($value);
}
