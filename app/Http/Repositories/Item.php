<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class Item
{

    public function insert(array $itemData): int
    {
        try {
            return DB::table('item')->insertGetId($itemData);
        } catch (Exception $e) {
            return 0;
        }
    }

    public function getItems($meetingId): int
    {
        try {
            $arrData = DB::table('item')
                ->select(['id', 'attendee_id', 'content', 'type'])
                ->where('meeting_id', $meetingId);

            return $arrData;
        } catch (Exception $e) {
            return 0;
        }
    }

    public function remove($itemId): int
    {
        try {
            return DB::table('item')->delete($itemId);
        } catch (Exception $e) {
            return 0;
        }
    }
}
