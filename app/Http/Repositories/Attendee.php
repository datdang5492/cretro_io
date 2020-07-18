<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class Attendee
{

    const IDEA_POST = 2;

    public function addAttendee(string $meetingId, string $attendeeId, string $attendeeName)
    {
        $data = [
            'id' => $attendeeId,
            'meeting_id' => $meetingId,
            'name' => $attendeeName
        ];
        return DB::table('attendee')->insert($data);
    }

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

    public function getSumUpList(string $meetingUuid): array
    {
        $summary = [];

        $attendees = DB::table('attendee')
            ->select(['id', 'name'])
            ->where('meeting_id', $meetingUuid)
            ->get()
            ->toArray();

        foreach ($attendees as $attendee) {
            $summary[$attendee->id] = [
                'name' => $attendee->name,
                'contributed_post' => 0,
                'contributed_idea' => 0,
                'received_vote' => 0,
            ];
        }
        unset($attendees);


        $items = DB::table('item')
            ->select(['attendee_id', 'vote', 'type'])
            ->where('meeting_id', $meetingUuid)
            ->get()
            ->toArray();

        foreach ($items as $item) {
            $attendeeId = $item->attendee_id;

            $summary[$attendeeId]['contributed_post']++;

            if ($item->type == self::IDEA_POST) {
                $summary[$attendeeId]['contributed_idea']++;
            }

            $summary[$attendeeId]['received_vote'] += $item->vote;
        }

        return $summary;
    }
}
