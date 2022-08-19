<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DailyAward extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'award:daily';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily award to NFT holders';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('Daily award task is running...');
        return 0;
    }
}
