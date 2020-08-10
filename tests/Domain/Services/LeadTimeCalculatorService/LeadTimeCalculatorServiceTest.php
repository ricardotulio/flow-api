<?php

namespace Flow\Domain\Services\LeadTimeCalculatorService;

use TestCase;
use DateTime;
use Flow\Domain\Entities\Card\CardInterface;
use Flow\Domain\Entities\Status\StatusInterface;

class LeadTimeCalculatorServiceTest extends TestCase
{
    /**
     * @test
     */
    public function mustCalculateTheCardLeadTime()
    {
        $commitmentPointStatus = $this->createMock(StatusInterface::class);
        $doneStatus = $this->createMock(StatusInterface::class);

        $calculatorService = new LeadTimeCalculatorService(
            $commitmentPointStatus,
            $doneStatus
        );

        $card = $this->createMock(CardInterface::class);

        $firstTimeInStatus = DateTime::createFromFormat('j-M-Y', '1-Feb-2020');

        $card->expects($this->any())
            ->method('getFirstTimeInStatus')
            ->willReturn($firstTimeInStatus);

        $lastTimeInStatus = DateTime::createFromFormat('j-M-Y', '20-Feb-2020');

        $card->expects($this->any())
            ->method('getLastTimeInStatus')
            ->willReturn($lastTimeInStatus);

        $leadtime = $calculatorService->calculate($card);

        $this->assertEquals(20, $leadtime);
    }
}
