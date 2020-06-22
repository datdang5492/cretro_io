<?php

namespace App\Http\Controllers\Retrospective;

use Exception;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Attendee;
use App\Http\Repositories\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MeetingManager extends Controller
{
    private $attendeeRepo;
    private $meetingRepo;
    private $strHelper;

    private $profileIcons = [
        'https://img.icons8.com/emoji/30/000000/crying-cat.png',
        'https://img.icons8.com/plasticine/30/000000/octopus.png',
        'https://img.icons8.com/plasticine/30/000000/cow.png',
        'https://img.icons8.com/plasticine/30/000000/pig.png',
        'https://img.icons8.com/plasticine/30/000000/reindeer.png',
        'https://img.icons8.com/dusk/30/000000/--camel.png',
        'https://img.icons8.com/officel/30/000000/giraffe.png'
    ];


    private $variants = [
        'variant_1',
        'variant_2',
        'variant_3',
        'variant_4',
        'variant_5',
        'variant_6',
        'variant_7',
        'variant_8',
    ];


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

    public function getMeetingInfo(Request $request)
    {
        try {
            $meetingId = $request->get('meetingId');
            $data = $this->meetingRepo->getMeetingInfo($meetingId);

            if (empty($data)) {
                return response()->json(['message' => 'meeting does not exist'], 404);
            }

            return response()->json($data, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function stop(Request $request)
    {
        try {
            $results = [];
            $meetingId = $request->get('meetingId');
            $attendees = $this->attendeeRepo->getSumUpList($meetingId);

            $key = 0;
            foreach ($attendees as $attendee) {
                $data = [
                    'total' => $this->calculateTotalScore($attendee),
                    'isConductor' => false,
                    'profilePic' => $this->profileIcons[$key],
                    '_rowVariant' => $this->variants[$key],
                ];
                $results[] = array_merge($data, $attendee);
                $key++;
            }

            usort($results, function (array $a, array $b) {
                return $b["total"] <=> $a["total"];
            });

            foreach ($results as $key => $result) {
                if ($result['total'] == 0) {
                    break;
                }

                if ($key >= 1 && $result['total'] < $results[$key - 1]) {
                    break;
                }
                $results[$key]['is_winner'] = true;
                $results[$key]['_rowVariant'] = 'secondary';
            }


            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


    private function calculateTotalScore(array $attendeeData): int
    {
        return $attendeeData['contributed_post'] * 2
            + $attendeeData['contributed_idea'] * 1
            + $attendeeData['received_vote'] * 1;
    }

    public function getAttendeeList(Request $request)
    {
        try {
            $results = [];
            $meetingId = $request->get('meetingId');
            $attendees = $this->attendeeRepo->getList($meetingId);

            $key = 0;
            foreach ($attendees as $attendee) {
                $conductor = !is_numeric($attendee->id) ? true : false;

                $results[] = [
                    'id' => $attendee->id,
                    'name' => $attendee->name,
                    'isConductor' => $conductor,
                    'profilePic' => $this->profileIcons[$key]
                ];
                $key++;
            }
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
