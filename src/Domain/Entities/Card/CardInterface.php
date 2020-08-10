<?php

namespace Flow\Domain\Entities\Card;

use DateTime;

interface CardInterface
{
    public function getId(): string;

    public function getTitle(): string;

    public function getDescription(): string;

    public function createdAt(): DateTime;

    public function udpatedAt(): DateTime;
}
