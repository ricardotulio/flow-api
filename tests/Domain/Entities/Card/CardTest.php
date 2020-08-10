<?php

namespace Flow\Domain\Entities\Card;

use TestCase;
use DateTime;
use Flow\Domain\Entities\Status\Status;
use Flow\Domain\Entities\StatusTransition\StatusTransition;
use Flow\Domain\Entities\StatusHistory\StatusHistory;

class CardTest extends TestCase
{
    /**
     * @test
     */
    public function mustReturnTheFirstTimeInStatus()
    {
        $statusInProgress = new Status('in_progress');
        $statusDone = new Status('done');

        $firstTransition = new StatusTransition(
            $statusInProgress,
            $statusDone,
            DateTime::createFromFormat('j-M-Y', '10-Sep-2020')
        );

        $secondTransition = new StatusTransition(
            $statusInProgress,
            $statusDone,
            DateTime::createFromFormat('j-M-Y', '15-Sep-2020')
        );

        $statusHistory = new StatusHistory();
        $statusHistory->addTransition($firstTransition)
            ->addTransition($secondTransition); 

        $card = new Card(
            'm5a1',
            $statusHistory
        );

        $firstTimeInStatus = $card->getFirstTimeInStatus($statusDone);

        $this->assertEquals(
            DateTime::createFromFormat('j-M-Y', '10-Sep-2020'),
            $firstTimeInStatus
        );
    }

    /**
     * @test
     */
    public function mustReturnTheLastTimeInStatus()
    {
        $statusInProgress = new Status('in_progress');
        $statusDone = new Status('done');

        $firstTransition = new StatusTransition(
            $statusInProgress,
            $statusDone,
            DateTime::createFromFormat('j-M-Y', '10-Sep-2020')
        );

        $secondTransition = new StatusTransition(
            $statusInProgress,
            $statusDone,
            DateTime::createFromFormat('j-M-Y', '15-Sep-2020')
        );

        $statusHistory = new StatusHistory();
        $statusHistory->addTransition($firstTransition)
            ->addTransition($secondTransition); 

        $card = new Card(
            'm5a1',
            $statusHistory
        );

        $lastTimeInStatus = $card->getLastTimeInStatus($statusDone);

        $this->assertEquals(
            DateTime::createFromFormat('j-M-Y', '15-Sep-2020'),
            $lastTimeInStatus
        );
    }
}
