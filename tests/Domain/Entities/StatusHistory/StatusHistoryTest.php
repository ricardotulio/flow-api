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
        $statusOpen = new Status('open');
        $statusInProgress = new Status('in_progress');
        $statusDone = new Status('done');

        $firstTransition = new StatusTransition(
            $statusOpen,
            $statusInProgress,
            DateTime::createFromFormat('j-M-Y', '1-Feb-2020')
        );

        $secondTransition = new StatusTransition(
            $statusInProgress,
            $statusDone,
            DateTime::createFromFormat('j-M-Y', '3-Feb-2020')
        );

        $thirdTransition = new StatusTransition(
            $statusDone,
            $statusInProgress,
            DateTime::createFromFormat('j-M-Y', '5-Feb-2020')
        );

        $fourthTransition = new StatusTransition(
            $statusDone,
            $statusInProgress,
            DateTime::createFromFormat('j-M-Y', '6-Feb-2020')
        );

        $statusHistory = new StatusHistory();
        $statusHistory->addTransition($firstTransition)
            ->addTransition($thirdTransition)
            ->addTransition($secondTransition)
            ->addTransition($fourthTransition);

        $this->assertEquals(
            $firstTransition,
            $statusHistory->getFirstTransitionToStatus($statusInProgress)
        );
    }

    /**
     * @test
     */
    public function mustReturnTheLastTransitionToStatus()
    {
        $statusOpen = new Status('open');
        $statusInProgress = new Status('in_progress');
        $statusDone = new Status('done');

        $firstTransition = new StatusTransition(
            $statusOpen,
            $statusInProgress,
            DateTime::createFromFormat('j-M-Y', '1-Feb-2020')
        );

        $secondTransition = new StatusTransition(
            $statusInProgress,
            $statusDone,
            DateTime::createFromFormat('j-M-Y', '3-Feb-2020')
        );

        $thirdTransition = new StatusTransition(
            $statusDone,
            $statusInProgress,
            DateTime::createFromFormat('j-M-Y', '5-Feb-2020')
        );

        $fourthTransition = new StatusTransition(
            $statusDone,
            $statusInProgress,
            DateTime::createFromFormat('j-M-Y', '6-Feb-2020')
        );

        $sixthTransition = new StatusTransition(
            $statusInProgress,
            $statusDone,
            DateTime::createFromFormat('j-M-Y', '7-Feb-2020')
        );

        $statusHistory = new StatusHistory();
        $statusHistory->addTransition($secondTransition)
            ->addTransition($thirdTransition)
            ->addTransition($firstTransition)
            ->addTransition($fourthTransition)
            ->addTransition($sixthTransition);

        $this->assertEquals(
            $sixthTransition,
            $statusHistory->getLastTransitionToStatus($statusDone)
        );
    }
}
