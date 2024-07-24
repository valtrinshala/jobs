<?php

namespace App\Http\Controllers\API\V1\ExternalJobs;

use App\Enums\ListingTypeEnum;
use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\ExternalJobs\CreateExternalJobRequest;
use App\Http\Resources\API\V1\JobResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\ExternalJob;
use App\Models\Provider;
use Illuminate\Http\JsonResponse;

class ExternalJobsCreateController extends APIController
{
    public function __invoke(CreateExternalJobRequest $request): JsonResponse
    {
        $data = $request->validated();

        $provider = $this->findProviderByName($data['provider'] ?? null);

        $country = $this->findOrCreateCountry($data['country'] ?? null);

        $city = $this->findOrCreateCity($data['city'] ?? null, $country);

        $data['provider_id'] = $provider?->id;
        $data['country_id'] = $country?->id;
        $data['city_id'] = $city->id ?? null;
        $categories = $data['categories'] ?? null;
        unset($data['provider']);
        unset($data['country']);
        unset($data['city']);
        unset($data['categories']);

        $job = ExternalJob::query()->create($data);

        $this->findOrCreateCategory($categories, $job, $country);

        return $this->respondWithSuccess(new JobResource($job), __('app.success'), 201);
    }

    private function findProviderByName(?string $providerName): ?Provider
    {
        if (!$providerName) {
            return null;
        }

        return Provider::where('name', 'LIKE', '%' . $providerName . '%')->first();
    }

    private function findOrCreateCountry(?string $countryName): ?Country
    {
        if (!$countryName) {
            return null;
        }

        $country = Country::where('name', 'LIKE', '%' . $countryName . '%')->first();

        if (!$country) {
            $country = Country::query()->create(['name' => $countryName]);
        }

        return $country;
    }

    private function findOrCreateCity(?string $cityName, ?Country $country)
    {
        if (!$cityName || !$country) {
            return null;
        }

        $city = City::query()->where('name', 'LIKE', '%' . $cityName . '%')->first();

        if (!$city) {
            $city = City::query()->create([
                'name' => $cityName,
                'country_id' => $country->id,
            ]);
        }

        return $city;
    }

    private function findOrCreateCategory(?array $categories, $job, $country = null): void
    {
        if (!$categories) {
            return;
        }

        foreach ($categories as $categoryName) {
            if (!$categoryName) {
                continue;
            }

            $category = Category::query()
                ->where('name', 'LIKE', '%' . $categoryName . '%')
                ->where('type', ListingTypeEnum::JOB->value)
                ->when($country, function ($query) use ($country) {
                    $query->where('country_id', $country?->id);
                })->first();

            if (!$category) {
                $category = Category::query()->create([
                    'name' => $categoryName,
                    'country_id' => $country?->id,
                    'type' => ListingTypeEnum::JOB->value
                ]);
            }

            $job->categories()->attach($category);
        }
    }
}
