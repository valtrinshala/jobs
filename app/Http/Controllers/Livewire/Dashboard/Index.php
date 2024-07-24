<?php

namespace App\Http\Controllers\Livewire\Dashboard;

use App\Models\Grant;
use App\Models\ExternalJob;
use App\Models\LocalJob;
use App\Models\Tender;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $localJobsTotal;
    public $externalJobsTotal;
    public $tendersTotal;
    public $grantsTotal;
    public $localJobsLastRecordUpdatedAt;
    public $externalJobsLastRecordUpdatedAt;
    public $tendersLastRecordUpdatedAt;
    public $grantsLastRecordUpdatedAt;

    public function mount()
    {
        $this->mountLocalJobsStats();
        $this->mountExternalJobsStats();
        $this->mountTendersStats();
        $this->mountGrantsStats();
    }

    public function render()
    {
        return view('dashboard.index');
    }

    protected function mountLocalJobsStats(): void
    {
        $this->localJobsTotal = LocalJob::query()->whereDate('deadline', '>', Carbon::now())->count() ?? 0;

        $updatedAt = LocalJob::query()->latest('id')->value('updated_at');

        if ($updatedAt) {
            $this->localJobsLastRecordUpdatedAt = $updatedAt->format('d.m.Y H:i');
        }
    }

    protected function mountExternalJobsStats(): void
    {
        $this->externalJobsTotal = ExternalJob::query()->count() ?? 0;

        $updatedAt = ExternalJob::query()->latest('id')->value('updated_at');

        if ($updatedAt) {
            $this->externalJobsLastRecordUpdatedAt = $updatedAt->format('d.m.Y H:i');
        }
    }

    protected function mountTendersStats(): void
    {
        $this->tendersTotal = Tender::query()->count() ?? 0;

        $updatedAt = Tender::query()->latest('id')->value('updated_at');

        if ($updatedAt) {
            $this->tendersLastRecordUpdatedAt = $updatedAt->format('d.m.Y H:i');
        }
    }

    protected function mountGrantsStats(): void
    {
        $this->grantsTotal = Grant::query()->count() ?? 0;

        $updatedAt = Grant::query()->latest('id')->value('updated_at');

        if ($updatedAt) {
            $this->grantsLastRecordUpdatedAt = $updatedAt->format('d.m.Y H:i');
        }
    }
}
