<?php

namespace App\Http\Controllers\Retrospective;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Attendee;
use App\Http\Repositories\Item;
use App\Http\Repositories\Meeting;
use Exception;
use Illuminate\Http\Request;

class ItemManager extends Controller
{
    private $itemRepo;
    private $attendeeRepo;
    private $meetingRepo;

    public function __construct(Item $item, Meeting $meeting, Attendee $attendee)
    {
        $this->itemRepo = $item;
        $this->meetingRepo = $meeting;
        $this->attendeeRepo = $attendee;
    }

    public function fetch(Request $request)
    {
        try {
            $results = [
                'goods' => [
                    [
                        'id' => 7,
                        'content' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        'vote' => 1,
                        'isVoted' => false,
                    ]
                ],
                'bads' => [
                    [
                        'id' => 1,
                        'content' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        'vote' => 1,
                        'isVoted' => false,
                    ]
                ],
                'ideas' => [
                    [
                        'id' => 1,
                        'content' => "Some quick example text to build on the card title and make up the bulk of the card's content.",
                        'vote' => 1,
                        'isVoted' => false,
                    ]
                ]
            ];

            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function add(Request $request)
    {
        try {
            $attendeeId = $request->get('attendeeId');
            $meetingId = $request->get('meetingId');

//            if (!$this->meetingRepo->doesMeetingExist($meetingId)){
//                return response()->json(['message' => 'meeting does not exist'], 500);
//            }
//
//            if (!$this->attendeeRepo->doesAttendeeExist($attendeeId)){
//                return response()->json(['message' => 'attendee does not exist'], 500);
//            }

            $item = [
                'meeting_id' => $meetingId,
                'attendee_id' => $attendeeId,
                'type' => $request->get('type'),
                'content' => $request->get('content')
            ];

            $id = $this->itemRepo->insert($item);
            return response()->json($id, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function vote(Request $request)
    {
        try {
            $results = [];
            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function edit(Request $request)
    {
        try {
            $results = [];
            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function remove(Request $request)
    {
        try {
            $itemId = $request->get('itemId');
            $attendeeId = $request->get('attendeeId');

//            if (!$this->attendeeRepo->doesAttendeeExist($attendeeId)){
//                return response()->json(['message' => 'attendee does not exist'], 500);
//            }

            $result = $this->itemRepo->remove($itemId);

            return response()->json($result, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
