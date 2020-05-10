<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class Attendee
{

    public function doesAttendeeExist(string $attendeeUuid): bool
    {
        try {
            $result = DB::table('attendee')
                ->where('id', $attendeeUuid)
                ->first();

            return !empty($result) ? true : false;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getList(string $meetingUuid): array
    {
        return DB::table('attendee')
            ->select(['id', 'name'])
            ->where('meeting_id', $meetingUuid)
            ->get()
            ->toArray();
    }
}
