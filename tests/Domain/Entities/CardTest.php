<?php

namespace Flow\Domain\Entities\Card;

use TestCase;
use DateTime;
use Flow\Domain\Entities\Status\StatusInterface;
use Flow\Domain\Entities\StatusHistory\StatusHistoryInterface;
use Flow\Domain\Entities\StatusTransition\StatusTransitionInterface;

class CardTest extends TestCase
{
    /**
     * @test
     */
    public function mustReturnTheFirstTimeInStatus()
    {
        $status = $this->createMock(StatusInterface::class);
        $statusTransition = $this->createMock(StatusTransitionInterface::class);
        $statusHistory = $this->createMock(StatusHistoryInterface::class);

        $statusTransition->expects($this->any())
            ->method('getTransitionDate')
            ->willReturn(DateTime::createFromFormat('j-M-Y', '10-Sep-2020'));

        $statusHistory->expects($this->any())
                      ->method('getFirstTransitionToStatus')
                      ->willReturn($statusTransition);

        $card = new Card(
            'm5a1',
            $statusHistory
        );

        $firstTimeInStatus = $card->getFirstTimeInStatus($status);

        $this->assertEquals(
            DateTime::createFromFormat('j-M-Y', '10-Sep-2020'),
            $firstTimeInStatus
        );
    }
}
