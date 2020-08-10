<?php

namespace Flow\Domain\Entities\Card;

use DateTime;
use Flow\Domain\Entities\Status\StatusInterface;
use Flow\Domain\Entities\StatusHistory\StatusHistoryInterface;

class Card implements CardInterface
{
    private string $id;
    private StatusHistoryInterface $statusHistory;

    public function __construct(
        string $id,
        StatusHistoryInterface $statusHistory
    ) {
        $this->id = $id;
        $this->statusHistory = $statusHistory;
    }

    public function getId(): string
    {
        return $this->getId();
    }

    public function getFirstTimeInStatus(StatusInterface $status): DateTime
    {
        $firstTransitionToStatus = $this->statusHistory
            ->getFirstTransitionToStatus($status);

        return $firstTransitionToStatus->getTransitionDate();
    }

    public function getLastTimeInStatus(StatusInterface $status): DateTime
    {
        $lastTransitionToStatus = $this->statusHistory
            ->getLastTransitionToStatus($status);

        return $lastTransitionToStatus->getTransitionDate();
    }
}
