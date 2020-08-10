<?php

namespace Flow\Domain\Entities\StatusHistory;

use Flow\Domain\Entities\Status\StatusInterface;
use Flow\Domain\Entities\StatusTransition\StatusTransitionInterface;

class StatusHistory implements StatusHistoryInterface
{
    private $transitions = [];

    public function addTransition(StatusTransitionInterface $statusTransition)
    {
        $this->transitions[] = $statusTransition;
    }

    public function getFirstTransitionToStatus(
        StatusInterface $status
    ): StatusTransitionInterface {
        return $this->transitions[0];
    } 
}
