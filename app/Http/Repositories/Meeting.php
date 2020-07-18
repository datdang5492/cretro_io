<?php

namespace App\Http\Repositories;

use Exception;
use Illuminate\Support\Facades\DB;

class Meeting
{
    const MEETING_STATUS_ACTIVE = 1;

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
            ->where([
                ['id', '=', $meetingId],
                ['status', '=', selF::MEETING_STATUS_ACTIVE]
            ])
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

    public function updateMeetingStatus(string $meetingId, string $userId, string $status): bool
    {
        return DB::table('meeting')
            ->where([
                ['id', '=', $meetingId],
                ['conductor_id', '=', $userId]
            ])
            ->update(['status' => $status]);
    }

    public function getMeetingIdByCode(string $meetingCode): string
    {
        $result = DB::table('meeting')
            ->select(['id'])
            ->where('code', $meetingCode)
            ->first();

        if (empty($result)) {
            return '';
        }

        return $result->id;
    }

}
