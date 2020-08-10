<?php

namespace Flow\Domain\Entities\Card;

use DateTime;
use Flow\Domain\Entities\Status\StatusInterface;

interface CardInterface
{
    public function getId(): string;

    public function getFirstTimeInStatus(StatusInterface $status): DateTime;

    public function getLastTimeInStatus(StatusInterface $status): DateTime;
}
