<?php

namespace MarekMikula\LaravelConsoleEvents\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Throwable;

class CommandErrorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var ConsoleErrorEvent
     */
    private $event;

    /**
     * CommandErrorEvent constructor.
     * @param ConsoleErrorEvent $event
     */
    public function __construct(ConsoleErrorEvent $event)
    {
        $this->event = $event;
    }

    /**
     * @return Command|null
     */
    public function getCommand()
    {
        return $this->event->getCommand();
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
     * @return Throwable
     */
    public function getError()
    {
        return $this->event->getError();
    }

    /**
     * @return int
     */
    public function getExitCode()
    {
        return $this->event->getExitCode();
    }
}
