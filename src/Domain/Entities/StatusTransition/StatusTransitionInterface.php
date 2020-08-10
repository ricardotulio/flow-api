<?php

namespace Flow\Domain\Entities\StatusTransition;

use DateTime;
use Flow\Domain\Entities\Status\StatusInterface;

interface StatusTransitionInterface
{
    public function getTransitionFrom(): StatusInterface;

    public function getTransitionTo(): StatusInterface;

    public function getTransitionDate(): DateTime;
}
