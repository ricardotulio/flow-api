<?php

namespace Flow\Domain\Entity\Ticket;

use DateTime;

interface TicketInterface
{
    public function getId(): string;

    public function getTitle(): string;

    public function getDescription(): string;

    public function createdAt(): DateTime;

    public function udpatedAt(): DateTime;
}
