<?php

namespace ShiranSE\OpenLibrary\Commands;

use Illuminate\Console\Command;

class OpenLibraryCommand extends Command
{
    public $signature = 'laravel-open-library';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
