<?php

namespace App\Console\Commands;

use App\Integration\NewPost\Collectors\NewPostCompositeCollector;
use Illuminate\Console\Command;

class CollectNewPostCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'collect:new_post';

    public function __construct(private NewPostCompositeCollector $collector)
    {
        parent::__construct();
    }

    public function handle(): void
    {
        $this->info('Start collect data from NewPost api.');
        $this->collector->collect();
        $this->info('Finished');
    }
}
