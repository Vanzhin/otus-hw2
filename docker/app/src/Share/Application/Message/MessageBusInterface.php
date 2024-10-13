<?php
declare(strict_types=1);


namespace App\Share\Application\Message;

use App\Share\Domain\Message\MessageInterface;
use Symfony\Component\Messenger\Envelope;

interface MessageBusInterface
{
    public function executeMessages(MessageInterface ...$messages): void;

    public function execute(Envelope $envelope): void;

}