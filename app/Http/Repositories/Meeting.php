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

    public function getMeetingInfo(string $meetingId): array
    {
        $data = DB::table('meeting')
            ->select([
                'conductor_id',
                'team_name',
                'sprint_name',
                'attendee_no',
                'max_vote',
                'duration',
                'status',
                'stopped_at',
                'created_at'
            ])
            ->where('id', $meetingId)
            ->first();

        if (empty($data)) {
            return [];
        }

        return [
            'conductor_id' => $data->conductor_id,
            'team_name' => $data->team_name,
            'sprint_name' => $data->sprint_name,
            'attendee_no' => $data->attendee_no,
            'max_vote' => $data->max_vote,
            'duration' => $data->duration,
            'meetingStatus' => $data->status,
            'stopped_at' => $data->stopped_at,
        ];
    }

    public function getUserMeetingList(string $conductorId): array
    {
        return DB::table('meeting')
            ->select([
                'id',
                'team_name',
                'sprint_name',
                'attendee_no',
                'max_vote',
                'duration',
                'status',
                'stopped_at',
                'created_at'
            ])
            ->where('conductor_id', $conductorId)
            ->get()
            ->sortByDesc('status')
            ->toArray();
    }
}
