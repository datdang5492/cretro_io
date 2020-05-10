<?php

namespace App\Http\Controllers\Retrospective;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Attendee;
use App\Http\Repositories\Meeting;
use Exception;
use Illuminate\Http\Request;

class MeetingManager extends Controller
{
    private $attendeeRepo;
    private $meetingRepo;

    public function __construct(Meeting $meeting, Attendee $attendee)
    {
        $this->meetingRepo = $meeting;
        $this->attendeeRepo = $attendee;
    }

    public function create(Request $request)
    {
        try {
            $results = [];
            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function start(Request $request)
    {
        try {
            $results = [];
            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function stop(Request $request)
    {
        try {
            $results = [];
            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function getAttendeeList(Request $request)
    {
        $profileIcons = [
            'https://img.icons8.com/emoji/30/000000/crying-cat.png',
            'https://img.icons8.com/plasticine/30/000000/octopus.png',
            'https://img.icons8.com/plasticine/30/000000/cow.png',
            'https://img.icons8.com/plasticine/30/000000/pig.png',
            'https://img.icons8.com/plasticine/30/000000/reindeer.png',
            'https://img.icons8.com/dusk/30/000000/--camel.png',
            'https://img.icons8.com/officel/30/000000/giraffe.png'
        ];

        try {
            $results = [];
            $meetingId = $request->get('meetingId');
            $attendees = $this->attendeeRepo->getList($meetingId);

            foreach ($attendees as $key => $attendee) {
                $conductor = !is_numeric($attendee->id) ? true : false;

                $results[] = [
                    'id' => $attendee->id,
                    'name' => $attendee->name,
                    'isConductor' => $conductor,
                    'profilePic' => $profileIcons[$key]
                ];
            }

//            $results = [
//                [
//                    'id' => 0,
//                    'name' => "Wahaab Bhatti",
//                    'score' => 7,
//                    'goodInputNo' => 2,
//                    'badInputNo' => 2,
//                    'actionInputNo' => 1,
//                    'givenVote' => 2,
//                    'isConductor' => false,
//                    'isWinner' => false,
//                ],
//                [
//                    'id' => 1,
//                    'name' => "Dat Dang",
//                    'score' => 7,
//                    'goodInputNo' => 2,
//                    'badInputNo' => 2,
//                    'actionInputNo' => 1,
//                    'givenVote' => 2,
//                    'isConductor' => true,
//                    'isWinner' => false,
//                ],
//                [
//                    'id' => 2,
//                    'name' => "Vasiliy Stepkin",
//                    'score' => 7,
//                    'goodInputNo' => 2,
//                    'badInputNo' => 2,
//                    'actionInputNo' => 1,
//                    'givenVote' => 2,
//                    'isConductor' => false,
//                    'isWinner' => false,
//                ],
//                [
//                    'id' => 3,
//                    'name' => "Stefan Schmidhuber",
//                    'score' => 7,
//                    'goodInputNo' => 2,
//                    'badInputNo' => 2,
//                    'actionInputNo' => 1,
//                    'givenVote' => 2,
//                    'isConductor' => false,
//                    'isWinner' => false,
//                ]
//            ];
            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function removeAttendee(Request $request)
    {
        try {
            $results = [];
            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
