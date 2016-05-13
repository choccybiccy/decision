<?php

namespace Choccybiccy\Decision;

/**
 * Interface EngineInterface.
 */
interface EngineInterface
{
    /**
     * @return Decision
     */
    public function decide();
}
