# Laravel console events #

## What is this package for? ##

This package allows you to use events that are triggered by the console. The events are:

`MarekMikula\LaravelConsoleEvents\Events\CommandErrorEvent` This event is triggered every time the command throws an exception.

`MarekMikula\LaravelConsoleEvents\Events\CommandExecutedEvent`  This event is triggered everytime before any command executes.

`MarekMikula\LaravelConsoleEvents\Events\CommandTerminatedEvent` This event is triggered everytime after any command terminates.
    
## How to install this package? ##

### Via composer ###

```
composer require marek-mikula/laravel-console-events
```

## How to use this package? ##

### Create listeners ###

Use Laravels command `php artisan make:listener` to create 
listeners which will listen to the events, which this package provides.
The listeners will be created in the `app/Listeners` folder.

Listeners could look like this:

```
<?php

namespace App\Listeners;

use MarekMikula\LaravelConsoleEvents\Events\CommandExecutedEvent;
use Illuminate\Support\Facades\Log;

class CommandExecutedListener
{
    /**
     * Handle the event.
     *
     * @param  CommandExecutedEvent  $event
     * @return void
     */
    public function handle(CommandExecutedEvent $event)
    {
        Log::info(sprintf('Command [%s] executed...',
            $event->getCommand()->getName()
        ));
    }
}
```

```
<?php

namespace App\Listeners;

use MarekMikula\LaravelConsoleEvents\Events\CommandErrorEvent;
use Illuminate\Support\Facades\Log;

class CommandErrorListener
{
    /**
     * Handle the event.
     *
     * @param  CommandErrorEvent  $event
     * @return void
     */
    public function handle(CommandErrorEvent $event)
    {
        Log::error(sprintf('Command [%s] threw an exception in file [%s] on line [%u]...',
            $event->getCommand()->getName(),
            $event->getError()->getFile(),
            $event->getError()->getLine()
        ));
    }
}
```

```
<?php

namespace App\Listeners;

use MarekMikula\LaravelConsoleEvents\Events\CommandTerminatedEvent;
use Illuminate\Support\Facades\Log;

class CommandTerminatedListener
{
    /**
     * Handle the event.
     *
     * @param  CommandTerminatedEvent  $event
     * @return void
     */
    public function handle(CommandTerminatedEvent $event)
    {
        Log::info(sprintf('Command [%s] terminated with exit code [%u]...',
            $event->getCommand()->getName(),
            $event->getExitCode()
        ));
    }
}
```

### Register listeners

Register created listeners in the `app\Providers\EventServiceProvider`.

```
/**
 * The event listener mappings for the application.
 *
 * @var array
 */
protected $listen = [
    \MarekMikula\LaravelConsoleEvents\Events\CommandExecutedEvent::class => [
        \App\Listeners\CommandExecutedListener::class,
    ],
    \MarekMikula\LaravelConsoleEvents\Events\CommandTerminatedEvent::class => [
        \App\Listeners\CommandTerminatedListener::class,
    ],
    \MarekMikula\LaravelConsoleEvents\Events\CommandErrorEvent::class => [
        \App\Listeners\CommandErrorListener::class,
    ],
];
```

## Results ##

Just use some testing command that throws an exception in its handle method, 
and you should see something similar.

```
[2020-08-18 19:34:55] local.INFO: Command [app:test] executed...  
[2020-08-18 19:34:55] local.ERROR: Command [app:test] threw an exception in file [...\app\Console\Commands\App\Test.php] on line [40]...  
[2020-08-18 19:34:55] local.INFO: Command [app:test] terminated with exit code [1]...  
```

## License ##

The MIT License (MIT). Please see [License File](LICENSE) for more information.