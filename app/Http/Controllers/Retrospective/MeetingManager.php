<?php

namespace App\Http\Controllers\Retrospective;

use App\Events\AttendeeJoinedEvent;
use Exception;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Attendee;
use App\Http\Repositories\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class MeetingManager extends Controller
{
    const MEETING_ARCHIVED_STATUS = 0;
    const MEETING_ACTIVE_STATUS = 1;
    const MEETING_CODE_LENGTH = 7;

    private $attendeeRepo;
    private $meetingRepo;
    private $strHelper;

    private $profileIcons = [
        'https://img.icons8.com/dusk/30/000000/tapir.png',
        'https://img.icons8.com/plasticine/30/000000/octopus.png',
        'https://img.icons8.com/plasticine/30/000000/cow.png',
        'https://img.icons8.com/plasticine/30/000000/pig.png',
        'https://img.icons8.com/plasticine/30/000000/reindeer.png',
        'https://img.icons8.com/dusk/30/000000/--camel.png',
        'https://img.icons8.com/dusk/30/000000/alpaca.png',
        'https://img.icons8.com/dusk/30/000000/bug.png',
        'https://img.icons8.com/dusk/30/000000/cat.png',
        'https://img.icons8.com/dusk/30/000000/stingray.png',
        'https://img.icons8.com/dusk/30/000000/running-away.png',
        'https://img.icons8.com/dusk/30/000000/crab.png',
        'https://img.icons8.com/dusk/30/000000/kiss-panda.png',
        'https://img.icons8.com/dusk/30/000000/walrus.png',
        'https://img.icons8.com/dusk/30/000000/turtle.png',
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
    const MAX_MEETING_ATTENDEE = 15;

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
                'maxVote' => 'required|numeric|min:1',
            ]);

            $code = $this->generateRandomCode();
            $meetingId = $this->strHelper->uuid()->toString();
            $data = [
                'team_name' => $request->get('teamName'),
                'sprint_name' => $request->get('sprintName'),
                'attendee_no' => $request->get('attendeeNo'),
                'max_vote' => $request->get('maxVote'),
                'conductor_id' => $userId,
                'code' => $code,
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

    private function generateRandomCode($length = self::MEETING_CODE_LENGTH): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function join(Request $request)
    {
        try {
            $request->validate([
                'meetingCode' => 'required',
                'userName' => 'required',
            ]);

            // check if meeting exist
            $meetingId = $this->meetingRepo->getMeetingIdByCode($request->get('meetingCode'));
            $userName = $request->get('userName');

            // meeting does not exist
            if (empty($meetingId)) {
                return response()->json(['message' => 'Invalid meeting code'], 400);
            }

            // check if meeting is already full - MAX 15 PEOPLE
            $currentMeetingAttendeeNo = $this->attendeeRepo->getMeetingAttendeeNumber($meetingId);
            if ($currentMeetingAttendeeNo >= self::MAX_MEETING_ATTENDEE) {
                return response()->json(
                    ['message' => 'Meeting is already full. Maximum number of attendee is ' . self::MAX_MEETING_ATTENDEE . ' :)'],
                    403);
            }


            // check if attendee name already exist in the meeting
            if ($this->attendeeRepo->checkAttendeeExistByName($userName, $meetingId)) {
                return response()->json(
                    ['message' => 'Attendee with this name already joined in the meeting, please use another name :)'],
                    400);
            }

            $attendeeId = $this->strHelper->uuid()->toString();
            $result = $this->attendeeRepo->addAttendee($meetingId, $attendeeId, $userName, $currentMeetingAttendeeNo);

            event(new AttendeeJoinedEvent(
                [
                    'name' => $userName,
                    'id' => $attendeeId,
                    'profilePic' => $this->profileIcons[$currentMeetingAttendeeNo],
                    'attendeeCode' => $attendeeId
                ],
                $meetingId)
            );

            if ($result === true) {
                return response()->json([
                    'meetingId' => $meetingId,
                    'attendeeId' => $attendeeId
                ], 200);
            }

            throw new Exception("Something wrong happened!");

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    // check attendee is authenticated with meeting code and valid name
    public function checkAttendee(Request $request)
    {
        try {
            $request->validate([
                'meetingCode' => 'required',
                'userName' => 'required',
            ]);

            // check if meeting exist
            $meetingId = $this->meetingRepo->getMeetingIdByCode($request->get('meetingCode'));
            $userName = $request->get('userName');

            // meeting does not exist
            if (empty($meetingId)) {
                return response()->json(['message' => 'Invalid meeting code'], 400);
            }

            // check if attendee name already exist in the meeting
            if (!$this->attendeeRepo->checkAttendeeExistByName($userName, $meetingId)) {
                return response()->json(
                    ['message' => 'Invalid attendee data'],
                    400);
            }

            return response()->json(['status' => true], 200);

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
                    'profilePic' => $this->profileIcons[$attendee->profile_pic],
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
                    'profilePic' => $this->profileIcons[$attendee->profile_pic]
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

    public function archiveMeeting(Request $request)
    {
        try {
            $userId = Auth::id();
            $meetingId = $request->get('meetingId');
            $result = $this->meetingRepo->updateMeetingStatus($meetingId, $userId, self::MEETING_ARCHIVED_STATUS);
            return response()->json(['data' => $result], 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function activateMeeting(Request $request)
    {
        try {
            $userId = Auth::id();
            $meetingId = $request->get('meetingId');
            $result = $this->meetingRepo->updateMeetingStatus($meetingId, $userId, self::MEETING_ACTIVE_STATUS);
            return response()->json(['data' => $result], 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
