<?php

namespace App\Services;

use App\Jobs\SendSmsJob;
use App\Models\Sms;
use App\Repositories\SmsRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SmsService
{
    public $smsRepo;
    function __construct()
    {
        $this->smsRepo = new SmsRepository();
    }


    public function sendSMS(array $smsData)
    {
        foreach ($smsData as $data) {
            $data['user_id'] = Auth::user()->id;
            $data['send_time'] = Carbon::now()->format("Y-m-d H:i:s");


            if (count($smsData) > 500) {
                $data['status'] = 1;
                $sms = $this->smsRepo->create($data);
                SendSmsJob::dispatch($sms); // Jobs que

            } else {
                $data['status'] = 0;
                $sms = $this->smsRepo->create($data);
            }
        }

        return true;
    }

    public function getById($sms)
    {
        return $this->smsRepo->getSmsWithUserById($sms);
    }


    public function listSMS(array $filter = [])
    {
        return $this->smsRepo->listSMSByUser($filter);
    }
}
