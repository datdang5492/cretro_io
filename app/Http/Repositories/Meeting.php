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
}
