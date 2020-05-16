<?php

namespace App\Http\Controllers\Retrospective;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Attendee;
use App\Http\Repositories\Meeting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MeetingManager extends Controller
{
    private $attendeeRepo;
    private $meetingRepo;
    private $strHelper;

    const MAX_MEETING_NUMBER = 2;

    public function __construct(Meeting $meeting, Attendee $attendee, Str $strHelper)
    {
        $this->meetingRepo = $meeting;
        $this->attendeeRepo = $attendee;
        $this->strHelper = $strHelper;
    }

    public function create(Request $request)
    {
        try {
            $userId = Auth::id();

            // check if user has ongoing meeting
            $unfinishedMeetings = $this->meetingRepo->getUserUnfinishedMeeting($userId);
            if (count($unfinishedMeetings) >= self::MAX_MEETING_NUMBER) {
                return response()->json(['message' => 'You currently already have at least 2 unfinished meetings'], 500);
            }

            $request->validate([
                'teamName' => 'required',
                'attendeeNo' => 'required|numeric|max:20',
                'duration' => 'required|numeric|min:10|max:180',
                'maxVote' => 'required|numeric|min:1',
            ]);

            $password = '';
            if (!empty($request->get('password'))) {
                $password = md5($request->get('password'));
            }

            $meetingId = $this->strHelper->uuid()->toString();
            $data = [
                'team_name' => $request->get('teamName'),
                'sprint_name' => $request->get('sprintName'),
                'attendee_no' => $request->get('attendeeNo'),
                'duration' => $request->get('duration'),
                'max_vote' => $request->get('maxVote'),
                'conductor_id' => $userId,
                'password' => $password,
                'id' => $meetingId
            ];

            $isMeetingCreated = $this->meetingRepo->create($data);
            if ($isMeetingCreated) {
                return response()->json($meetingId, 200);
            }

            throw new Exception("Something wrong happened!");

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
