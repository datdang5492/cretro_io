<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class Meeting
{

    public function doesMeetingExist(string $uuid): bool
    {
        try {
            $result = DB::table('meeting')
                ->where('id', $uuid)
                ->first();
            return !empty($result) ? true : false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function create(array $data): bool
    {
        return DB::table('meeting')->insert($data);
    }

    public function getUserUnfinishedMeeting(string $userId): array
    {
        return DB::table('meeting')
            ->select('id')
            ->where('conductor_id', $userId)
            ->whereNull('stopped_at')
            ->get()
            ->toArray();
    }
}
