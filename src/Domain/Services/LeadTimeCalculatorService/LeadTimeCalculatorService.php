<?php

namespace Flow\Domain\Services\LeadTimeCalculatorService;

use Flow\Domain\Entities\Card\CardInterface;
use Flow\Domain\Entities\Status\StatusInterface;

class LeadTimeCalculatorService
{
    public function calculate(
        StatusInterface $commitmentPoint,
        StatusInterface $deliveryPoint,
        CardInterface $card
    ): int {
        $commitedAt = $card->getFirstTimeInStatus($commitmentPoint);
        $deliveredAt = $card->getLastTimeInStatus($deliveryPoint);

        $leadtime = (int) $commitedAt->diff($deliveredAt)->days;

        return $leadtime;
    }
}
