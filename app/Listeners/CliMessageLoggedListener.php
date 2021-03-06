<?php

namespace App\Listeners;

use Illuminate\Log\Events\MessageLogged;
use Symfony\Component\Console\Output\ConsoleOutput;
use function app;

class CliMessageLoggedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private ConsoleOutput $output)
    {}

    /**
     * Handle the event.
     *
     * @param MessageLogged $event
     * @return void
     */
    public function handle(MessageLogged $event): void
    {
        if (app()->runningInConsole()) {
            $this->output->writeln("<info>{$event->message}</info>");
        }
    }
}
