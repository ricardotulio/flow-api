<?php

namespace Flow\Domain\Services\LeadTimeCalculatorService;

use Flow\Domain\Entities\Card\CardInterface;
use Flow\Domain\Entities\Status\StatusInterface;

class LeadTimeCalculatorService
{
    public function calculate(CardInterface $card): int
    {
        return 20;
    }
}
