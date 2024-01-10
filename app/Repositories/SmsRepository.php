<?php

namespace App\Repositories;

use App\Models\Sms;
use Illuminate\Support\Facades\Auth;

class SmsRepository
{
    public function getAll()
    {
        return Sms::all();
    }

    public function getSmsWithUserById($id)
    {
        return Sms::with("user")->where("user_id", Auth::user()->id)->where("id", $id)->firstOrFail();
    }

    public function listSMSByUser(array $filter = [])
    {
        // İlk olarak ilişkilendirilmiş sorguyu başlatıyoruz
        $query = Auth::user()->sms_messages()->with("user");

        // 'send_time' filtresini kontrol ediyoruz ve uyguluyoruz
        if (!empty($filter['send_time'])) {
            $query->where('send_time', '<=', $filter['send_time']);
        }

        // Sorguyu çalıştırıp sonuçları dönüyoruz
        return $query->get();
    }
    public function create(array $data)
    {
        return Sms::create($data);
    }

    public function update($id, array $data)
    {
        $sms = $this->getById($id);
        $sms->update($data);
        return $sms;
    }

    public function delete($id)
    {
        $sms = $this->getById($id);
        $sms->delete();
    }
}
