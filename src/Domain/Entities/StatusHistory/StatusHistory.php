<?php

namespace Flow\Domain\Entities\StatusHistory;

use Flow\Domain\Entities\Status\StatusInterface;
use Flow\Domain\Entities\StatusTransition\StatusTransitionInterface;

class StatusHistory implements StatusHistoryInterface
{
    private $transitions = [];

    public function addTransition(StatusTransitionInterface $statusTransition)
    {
        $this->transitions[] = $statusTransition;
        return $this;
    }

    private function getTransitionsTo($transitions, StatusInterface $status)
    {
        return array_filter(
            $transitions,
            function ($transition) use ($status) {
                $transitionTo = $transition->getTransitionTo();
                return $transitionTo->getId() == $status->getId();
            }
        );
    }

    private function sortByTransitionDate($transitions)
    {
        usort($transitions, function($a, $b) {
            return $a->getTransitionDate() <=> $b->getTransitionDate();
        });

        return $transitions;
    }

    public function getFirstTransitionToStatus(
        StatusInterface $status
    ): StatusTransitionInterface {
        $transitionsToStatus = $this->getTransitionsTo(
            $this->transitions,
            $status
        );

        $sortedByTransitionDate = $this->sortByTransitionDate(
            $transitionsToStatus
        );

        return array_shift($sortedByTransitionDate);
    } 

    public function getLastTransitionToStatus(
        StatusInterface $status
    ): StatusTransitionInterface {
        $transitionsToStatus = $this->getTransitionsTo(
            $this->transitions,
            $status
        );

        $sortedByTransitionDate = $this->sortByTransitionDate(
            $transitionsToStatus
        );

        return array_pop($sortedByTransitionDate);
    }
}
