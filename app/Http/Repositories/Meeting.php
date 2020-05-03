<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class Meeting
{

    public function doesMeetingExist(string $id): bool
    {
        try {
            $result = DB::table('meeting')
                ->first(['id' => $id]);
            return !empty($result) ? true : false;
        } catch (Exception $e) {
            return false;
        }
    }
}
