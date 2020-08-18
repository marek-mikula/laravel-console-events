<?php

namespace MarekMikula\LaravelConsoleEvents\Listeners;

use Illuminate\Console\Events\ArtisanStarting;
use MarekMikula\LaravelConsoleEvents\Events\CommandErrorEvent;
use MarekMikula\LaravelConsoleEvents\Events\CommandExecutedEvent;
use MarekMikula\LaravelConsoleEvents\Events\CommandTerminatedEvent;
use Symfony\Component\Console\ConsoleEvents;
use Symfony\Component\Console\Event\ConsoleCommandEvent;
use Symfony\Component\Console\Event\ConsoleErrorEvent;
use Symfony\Component\Console\Event\ConsoleTerminateEvent;
use Symfony\Component\EventDispatcher\EventDispatcher;

class ArtisanStartingListener
{
    /**
     * @param ArtisanStarting $event
     */
    public function handle(ArtisanStarting $event): void
    {
        /**
         * We have to register Symphony events
         * and set the dispatcher to artisan instance
         * because otherwise the events would never trigger
         * and they can't be register trough the Event facade
         */
        $symphonyEventDispatcher = new EventDispatcher();

        $symphonyEventDispatcher->addListener(ConsoleEvents::ERROR, function (ConsoleErrorEvent $event) {
            event(new CommandErrorEvent($event));
        });
        $symphonyEventDispatcher->addListener(ConsoleEvents::TERMINATE, function (ConsoleTerminateEvent $event) {
            event(new CommandTerminatedEvent($event));
        });
        $symphonyEventDispatcher->addListener(ConsoleEvents::COMMAND, function (ConsoleCommandEvent $event) {
            event(new CommandExecutedEvent($event));
        });

        $event->artisan->setDispatcher($symphonyEventDispatcher);
    }
}
