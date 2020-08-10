<?php

namespace Flow\Domain\Services\LeadTimeCalculatorService;

use Flow\Domain\Entities\Status\CardInterface;
use Flow\Domain\Entities\Status\StatusInterface;

interface LeadTimeCalculatorServiceInterface
{
    public function calculate(
        StatusInterface $commitmentPoint,
        StatusInterface $deliveryPoint,
        CardInterface $card
    ): int;
}
