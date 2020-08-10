<?php

use PHPUnit\Framework\TestCase;

use Flow\Domain\Entities\Status\Status;
use Flow\Domain\Entities\StatusTransition\StatusTransition;
use Flow\Domain\Entities\StatusHistory\StatusHistory;

class StatusHistoryTest extends TestCase
{
    /**
     * @test
     */
    public function mustReturnTheFirstTransitionToStatus()
    {
        $statusInProgress = new Status('in_progress');
        $statusDone = new Status('done');

        $firstTransition = new StatusTransition(
            $statusInProgress,
            $statusDone,
            DateTime::createFromFormat('j-M-Y', '1-Feb-2020')
        );

        $secondTransition = new StatusTransition(
            $statusDone,
            $statusInProgress,
            DateTime::createFromFormat('j-M-Y', '3-Feb-2020')
        );

        $thirdTransition = new StatusTransition(
            $statusInProgress,
            $statusDone,
            DateTime::createFromFormat('j-M-Y', '5-Feb-2020')
        );

        $statusHistory = new StatusHistory();
        $statusHistory->addTransition($firstTransition);
        $statusHistory->addTransition($thirdTransition);
        $statusHistory->addTransition($secondTransition);

        $this->assertEquals(
            $firstTransition,
            $statusHistory->getFirstTransitionToStatus($statusInProgress)
        );
    }
}
