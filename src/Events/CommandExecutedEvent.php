<?php

namespace MarekMikula\LaravelConsoleEvents\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CommandExecutedEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ConsoleCommandEvent
     */
    private $event;

    /**
     * CommandExecutedEvent constructor.
     * @param ConsoleCommandEvent $event
     */
    public function __construct(ConsoleCommandEvent $event)
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
}
