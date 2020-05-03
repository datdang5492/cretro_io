<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class Attendee
{

    public function doesAttendeeExist(int $id): bool
    {
        try {
            $result = DB::table('attendee')->first(['id' => $id]);
            return !empty($result) ? true : false;
        } catch (Exception $e) {
            return false;
        }
    }
}
