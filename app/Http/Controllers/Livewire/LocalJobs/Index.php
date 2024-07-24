<?php

namespace App\Http\Controllers\Livewire\LocalJobs;

use App\Enums\ListingTypeEnum;
use App\Filters\LocalJobFilter;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\LocalJob;
use App\Models\Provider;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public ?string $query = '';
    public ?string $provider = null;
    public ?string $city = null;
    public ?string $country = 'kosovo';
    public ?string $category = null;
    public ?string $work_type = null;
    public ?string $job_type = null;

    public Collection $providers;

    public $cities;

    public $categories;

    public Collection $countries;


    protected $queryString = [
        'page' => ['except' => 1, 'as' => 'p'],
        'query' => ['except' => '', 'as' => 'q'],
        'provider' => ['except' => ''],
        'city' => ['except' => ''],
        'country' => ['except' => ''],
        'category' => ['except' => ''],
        'work_type' => ['except' => ''],
        'job_type' => ['except' => ''],
    ];

    public function updating()
    {
        $this->resetPage();
    }

    public function updatedCountry(): void
    {
        $this->city = null;
        $this->category = null;
    }

    public function mount()
    {
//        $this->providers = Provider::query()->get();
//        $this->countries = Country::query()->get();
    }

    public function render()
    {
        $cacheKey = $this->generateCacheKey();

        $cachedData = Cache::remember($cacheKey, 1440, function () {
            $jobs = LocalJob::query()
                ->with('provider', 'categories', 'country', 'city', 'provider')
                ->filter(new LocalJobFilter($this))
                ->when($this->country == 'kosovo', function ($query) {
                    $query->whereDate('deadline', '>', Carbon::now());
                })
                ->latest()
                ->paginate(50);

            $countryId = Country::query()->where('slug', $this->country)->first()->id ?? null;

            if ($countryId) {
                $cities = City::query()->where('country_id', $countryId)->orderBy('name')->get();
                $categories = Category::query()
                    ->where('country_id', $countryId)
                    ->where('type', ListingTypeEnum::JOB->value)
                    ->orderBy('name')
                    ->get();
            } else {
                $cities = City::query()->orderBy('name')->get();
                $categories = Category::query()->where('type', ListingTypeEnum::JOB->value)->orderBy('name')->get();
            }

            return compact('jobs', 'cities', 'categories');
        });

        $jobs = $cachedData['jobs'];
        $this->cities = $cachedData['cities'];
        $this->categories = $cachedData['categories'];

        return view('local-jobs.index', compact('jobs'));
    }

    public function deleteItem(LocalJob $job): void
    {
        $job->delete();

        notify_success("The job has been deleted.", $this);
    }

    protected function generateCacheKey(): string
    {
        $page = $this->page ?? 1;

        $filters = [
            'query' => $this->query,
            'provider' => $this->provider,
            'city' => $this->city,
            'country' => $this->country,
            'category' => $this->category,
            'work_type' => $this->work_type,
            'job_type' => $this->job_type,
        ];

        return 'local_jobs_page_' . $page . '_' . md5(json_encode($filters));
    }
}
