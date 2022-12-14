<?php

namespace App\Http\Controllers;

use App\Libs\Response\GlobalApiResponse;
use App\Libs\Response\GlobalApiResponseCodeBook;
use App\Http\Requests\Bookings\GetJobHistoryRequest;
use App\Services\BookingService;

class BookingController extends Controller
{
    public function __construct(BookingService $BookingService, GlobalApiResponse $GlobalApiResponse)
    {
        $this->booking_service = $BookingService;
        $this->global_api_response = $GlobalApiResponse;
    }

    public function getJobHistory(GetJobHistoryRequest $request)
    {
        $job_history = $this->booking_service->getJobHistory($request);
        
        if ($job_history === GlobalApiResponseCodeBook::RECORD_NOT_EXISTS['outcomeCode'])
            return ($this->global_api_response->error(GlobalApiResponseCodeBook::RECORD_NOT_EXISTS, "Job history details not found!", []));

        if (!$job_history)
            return ($this->global_api_response->error(GlobalApiResponseCodeBook::INTERNAL_SERVER_ERROR, "Job history details did not fetched!", $job_history));

        return ($this->global_api_response->success(count($job_history), "Job history details fetched successfully!", $job_history));
    }
}
