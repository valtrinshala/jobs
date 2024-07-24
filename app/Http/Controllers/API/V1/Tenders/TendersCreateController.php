<?php

namespace App\Http\Controllers\API\V1\Tenders;

use App\Enums\ListingTypeEnum;
use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Tenders\CreateTenderRequest;
use App\Http\Resources\API\V1\TenderResource;
use App\Models\Category;
use App\Models\City;
use App\Models\Country;
use App\Models\Provider;
use App\Models\Tender;
use Illuminate\Http\JsonResponse;

class TendersCreateController extends APIController
{
    public function __invoke(CreateTenderRequest $request): JsonResponse
    {
        $data = $request->validated();

        $existingTender = Tender::query()
            ->where('name', 'LIKE', '%' . $data['name'] . '%')
            ->when(isset($data['deadline']), function ($query) use ($data) {
                $query->where('deadline', $data['deadline']);
            })
            ->exists();

        if ($existingTender) {
            return $this->respondWithError('Tender already exists');
        }

        $provider = $this->findProviderByName($data['provider'] ?? null);

        $country = $this->findOrCreateCountry($data['country']);

        $city = $this->findOrCreateCity($data['city'] ?? null, $country);

        $data['provider_id'] = $provider?->id;
        $data['country_id'] = $country?->id;
        $data['city_id'] = $city->id ?? null;
        $categories = $data['categories'] ?? null;

        unset($data['provider']);
        unset($data['country']);
        unset($data['city']);
        unset($data['categories']);

        $tender = Tender::query()->create($data);

        $this->findOrCreateCategory($categories, $tender, $country);

        return $this->respondWithSuccess(new TenderResource($tender), __('app.success'), 201);
    }

    private function findProviderByName(?string $providerName): ?Provider
    {
        if (!$providerName) {
            return null;
        }

        return Provider::where('name', 'LIKE', '%' . $providerName . '%')->first();
    }

    private function findOrCreateCountry(string $countryName): ?Country
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

    private function findOrCreateCity(?string $cityName, Country $country)
    {
        if (!$cityName) {
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

    private function findOrCreateCategory(?array $categories, $tender, $country = null): void
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
                ->where('type', ListingTypeEnum::TENDER->value)
                ->when($country, function ($query) use ($country) {
                    $query->where('country_id', $country?->id);
                })->first();

            if (!$category) {
                $category = Category::query()->create([
                    'name' => $categoryName,
                    'country_id' => $country?->id,
                    'type' => ListingTypeEnum::TENDER->value
                ]);
            }

            $tender->categories()->attach($category);
        }
    }
}
