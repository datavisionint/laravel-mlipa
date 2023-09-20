<?php

namespace DatavisionInt\Mlipa\Commands;

use Illuminate\Console\Command;

class MlipaCommand extends Command
{
    public $signature = 'laravel-mlipa';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
