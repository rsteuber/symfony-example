<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Manager;

use Symfony\Component\Messenger\MessageBusInterface;

class MessageDispatcher
{
    public function __construct(private readonly MessageBusInterface $messageBus)
    {
    }

    public function dispatch(object $message): void
    {
        $this->messageBus->dispatch($message);
    }

}