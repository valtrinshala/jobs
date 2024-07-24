<?php

namespace App\Console\Commands;

use App\Jobs\TranslateJobTitle;
use App\Models\ExternalJob;
use Illuminate\Console\Command;

class TranslateJobTitles extends Command
{
    protected $signature = 'app:translate-job-titles';

    protected $description = 'Command description';

    public function handle()
    {
        ExternalJob::query()->whereNull('english_name')
            ->whereHas('provider', fn($query) => $query->where('name', 'ArbeitsAgentur'))
            ->where('id', '>', 74287)
            ->lazyById()
            ->each(function (ExternalJob $job) {
                TranslateJobTitle::dispatch($job);
            });
    }
}
