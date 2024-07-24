<?php

namespace App\Jobs;

use App\Models\ExternalJob;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateJobTitle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(private ExternalJob $jobListing)
    {
    }

    public function handle(): void
    {
        try {
            $tr = new GoogleTranslate();
            $tr->setSource('de');
            $tr->setTarget('en');

            $translatedTitle = $tr->translate($this->jobListing->name);

            $this->jobListing->english_name = $translatedTitle;
            $this->jobListing->save();
        } catch (\Exception $e) {
            report($e);
        }
    }
}
