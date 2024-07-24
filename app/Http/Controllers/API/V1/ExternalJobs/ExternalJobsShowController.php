<?php

namespace App\Http\Controllers\API\V1\ExternalJobs;

use App\Http\Controllers\API\APIController;
use App\Http\Requests\API\V1\ExternalJobs\ShowExternalJobRequest;
use App\Models\ExternalJob;

class ExternalJobsShowController extends APIController
{
    public function __invoke(ShowExternalJobRequest $request)
    {
        $data = $request->validated();

        $job = ExternalJob::query()->where(function ($query) use ($data) {

            foreach ($data as $key => $value) {
                $query->where($key, 'LIKE', '%' . $value . '%');
            }
        })->first();

        return $this->respondWithSuccess($job);
    }
}
