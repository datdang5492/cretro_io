<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Attendee;
use App\Http\Repositories\Meeting;
use Exception;
use Illuminate\Http\Request;

class ProfileManager extends Controller
{
    private $attendeeRepo;
    private $meetingRepo;

    public function __construct(Meeting $meeting, Attendee $attendee)
    {
        $this->meetingRepo = $meeting;
        $this->attendeeRepo = $attendee;
    }

    public function getMeetingList(Request $request)
    {
        try {
            $results = [
                [
                    'id' => 'uuid',
                    'attendeeNo' => 7,
                    'sprintName' => '2020_02',
                    'teamName' => 'Cerberus',
                    'duration' => 60,
                    'time' => '14.02.2020',
                    'status' => 1
                ],
                [
                    'id' => 'uuid',
                    'attendeeNo' => 10,
                    'sprintName' => '2020_03',
                    'teamName' => 'Cerberus',
                    'duration' => 60,
                    'time' => '29.02.2020',
                    'status' => 0
                ],
                [
                    'id' => 'uuid',
                    'attendeeNo' => 5,
                    'sprintName' => '2020_03',
                    'teamName' => 'Prometheus',
                    'duration' => 60,
                    'time' => '29.02.2020',
                    'status' => 0
                ],
                [
                    'id' => 'uuid',
                    'attendeeNo' => 6,
                    'sprintName' => '2020_03',
                    'teamName' => 'Prometheus',
                    'duration' => 60,
                    'time' => '29.02.2020',
                    'status' => 0
                ]

            ];


            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
