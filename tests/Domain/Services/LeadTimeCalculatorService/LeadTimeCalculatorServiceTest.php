<?php

namespace Flow\Domain\Services\LeadTimeCalculatorService;

use TestCase;
use DateTime;
use Flow\Domain\Entities\Status\Status;
use Flow\Domain\Entities\Card\CardInterface;

class LeadTimeCalculatorServiceTest extends TestCase
{
    private $prophet;

    /**
     * @test
     */
    public function mustCalculateTheCardLeadTime()
    {
        $commitmentPoint = new Status('sprint_backlog');
        $deliveryPoint = new Status('released');

        $card = $this->prophet->prophesize(CardInterface::class);
        
        $card->getFirstTimeInStatus($commitmentPoint)
            ->willReturn(DateTime::createFromFormat('j-M-Y', '1-Feb-2020'));

        $card->getLastTimeInStatus($deliveryPoint)
             ->willReturn(DateTime::createFromFormat('j-M-Y', '21-Feb-2020'));

        $card = $card->reveal();

        $calculatorService = new LeadTimeCalculatorService();

        $leadtime = $calculatorService->calculate(
            $commitmentPoint,
            $deliveryPoint,
            $card
        );

        $this->assertEquals(20, $leadtime);
    }

    protected function setUp(): void
    {
        $this->prophet = new \Prophecy\Prophet;
    }

    protected function tearDown(): void
    {
        $this->prophet->checkPredictions();
    }
}
