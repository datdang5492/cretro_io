<?php

namespace App\Http\Repositories;

use Illuminate\Support\Facades\DB;
use Exception;
use Throwable;

class Item
{
    public function insert(array $itemData): int
    {
        return DB::table('item')->insertGetId($itemData);
    }

    public function getItems(string $meetingId): array
    {
        return DB::table('item')
            ->select(['id', 'attendee_id', 'content', 'vote', 'type'])
            ->where('meeting_id', $meetingId)
            ->get()
            ->sortByDesc('id')
            ->toArray();
    }

    public function getItemTotalVote(int $itemId): int
    {
        $result = DB::table('item')
            ->select('vote')
            ->where('id', $itemId)
            ->first();

        if (empty($result)) {
            throw new Exception("Empty vote");
        }
        return $result->vote;
    }

    public function getVotes(string $attendeeId): array
    {
        return DB::table('vote')
            ->select('*')
            ->where('attendee_id', $attendeeId)
            ->get()
            ->toArray();
    }

    public function vote(int $itemId, string $attendeeId, bool $value): bool
    {
        try {
            $data = [
                'item_id' => $itemId,
                'attendee_id' => $attendeeId
            ];

            if ($value === true) {
                return DB::table('vote')->insert($data);
            }

            return DB::table('vote')->where('item_id', $itemId)->delete();
        } catch (Throwable $e) {
            dd($e->getMessage());
            return false;
        }
    }

    // update item content
    public function updateItemContent(int $itemId, string $content, string $attendeeId): bool
    {
        return DB::table('item')
            ->where([
                ['id', '=', $itemId],
                ['attendee_id', '=', $attendeeId]
            ])
            ->update(['content' => $content]);
    }

    // update total vo number of an item
    public function updateTotalVote(int $itemId, bool $value): bool
    {
        try {
            if ($value === true) {
                return DB::table('item')->where('id', $itemId)->increment('vote');
            } else {
                return DB::table('item')->where('id', $itemId)->decrement('vote');
            }
        } catch (Throwable $e) {
            return false;
        }
    }

    // remove an item
    public function remove($itemId, string $attendeeId): int
    {
        return DB::table('item')
            ->where([
                ['id', '=', $itemId],
                ['attendee_id', '=', $attendeeId]
            ])
            ->delete($itemId);
    }
}
