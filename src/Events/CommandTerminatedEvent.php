<?php

namespace MarekMikula\LaravelConsoleEvents\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandTerminatedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ConsoleTerminateEvent
     */
    private $event;

    /**
     * CommandTerminatedEvent constructor.
     * @param ConsoleTerminateEvent $event
     */
    public function __construct(ConsoleTerminateEvent $event)
    {
        $this->event = $event;
    }

    /**
     * @return InputInterface
     */
    public function getInput()
    {
        return $this->event->getInput();
    }

    /**
     * @return OutputInterface
     */
    public function getOutput()
    {
        return $this->event->getOutput();
    }

    /**
     * @return Command|null
     */
    public function getCommand()
    {
        return $this->event->getCommand();
    }

    /**
     * @return int
     */
    public function getExitCode()
    {
        return $this->event->getExitCode();
    }
}
