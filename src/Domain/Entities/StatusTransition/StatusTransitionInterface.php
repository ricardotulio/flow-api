<?php

namespace Flow\Domain\Entities\StatusTransition;

use DateTime;
use Flow\Domain\Entities\Status\StatusInterface;

interface StatusTransitionInterface
{
    public function getStatusFrom(): StatusInterface;

    public function getStatusTo(): StatusInterface;

    public function getTransitionDate(): DateTime;
}
