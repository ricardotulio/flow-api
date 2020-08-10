<?php

namespace Flow\Domain\Entities\StatusTransition;

use DateTime;
use Flow\Domain\Entities\Status\StatusInterface;

class StatusTransition implements StatusTransitionInterface
{
    private StatusInterface $transitionFrom;
    private StatusInterface $transitionTo;
    private DateTime $transitionDate;

    public function __construct(
        StatusInterface $transitionFrom,
        StatusInterface $transitionTo,
        DateTime $transitionDate
    ) {
        $this->transitionFrom = $transitionFrom;
        $this->transitionTo = $transitionTo;
        $this->transitionDate = $transitionDate;
    }

    public function getTransitionFrom(): StatusInterface
    {
        return $this->transitionFrom;
    }

    public function getTransitionTo(): StatusInterface
    {
        return $this->transitionTo;
    }

    public function getTransitionDate(): DateTime
    {
        return $this->transitionDate;
    }
}
