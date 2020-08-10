<?php

namespace Flow\Domain\Entities\StatusHistory;

use Flow\Domain\Entities\Status\StatusInterface;
use Flow\Domain\Entities\StatusTransition\StatusTransitionInterface;

interface StatusHistoryInterface
{
    public function getFirstTransitionToStatus(
        StatusInterface $status
    ): StatusTransitionInterface;
}
