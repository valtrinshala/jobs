<?php

namespace App\Http\Controllers\API\V1\LocalJobs;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\LocalJobs\ShowLocalJobRequest;
use App\Models\LocalJob;

class LocalJobsShowController extends APIController
{
    public function __invoke(ShowLocalJobRequest $request)
    {
        $data = $request->validated();

        $job = LocalJob::query()->where(function ($query) use ($data) {

            foreach ($data as $key => $value) {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        })->first();

        return $this->respondWithSuccess($job);
    }
}
