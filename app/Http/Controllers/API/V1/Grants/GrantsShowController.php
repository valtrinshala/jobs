<?php

namespace App\Http\Controllers\API\V1\Grants;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\Grants\ShowGrantRequest;
use App\Models\Grant;

class GrantsShowController extends APIController
{
    public function __invoke(ShowGrantRequest $request)
    {
        $data = $request->validated();

        $grant = Grant::query()->where(function ($query) use ($data) {
            foreach ($data as $key => $value) {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        })->first();

        return $this->respondWithSuccess($grant);
    }
}
