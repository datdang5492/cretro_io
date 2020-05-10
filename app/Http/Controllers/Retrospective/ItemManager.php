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
            $meetingId = $request->get('meetingId');
            $attendeeId = $request->get('attendeeId');

            $items = $this->itemRepo->getItems($meetingId);
            if (empty($items)) {
                return response()->json([], 200);
            }

            $votes = $this->itemRepo->getVotes($attendeeId);
            $userVotes = [];
            foreach ($votes as $vote) {
                $userVotes[$vote->item_id] = $vote->attendee_id;
            }

            $results = [
                'goods' => [],
                'bads' => [],
                'ideas' => [],
            ];
            foreach ($items as $key => $item) {
                $isVoted = false;
                if (!empty($userVotes[$item->id]) && $userVotes[$item->id] === $attendeeId) {
                    $isVoted = true;
                }

                $ticket = [
                    'id' => $item->id,
                    'content' => $item->content,
                    'isVoted' => $isVoted,
                    'vote' => $item->vote
                ];
                if ($item->type === 0) {
                    $results['goods'][] = $ticket;
                } else if ($item->type === 1) {
                    $results['bads'][] = $ticket;
                } else if ($item->type === 2) {
                    $results['ideas'][] = $ticket;
                }
            }

            return response()->json($results, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function add(Request $request)
    {
        try {
            $meetingId = $request->get('meetingId');
            if (!$this->meetingRepo->doesMeetingExist($meetingId)) {
                return response()->json(['message' => 'meeting does not exist'], 500);
            }

            $attendeeId = $request->get('attendeeId');
            if (!$this->attendeeRepo->doesAttendeeExist($attendeeId)) {
                return response()->json(['message' => 'attendee does not exist'], 500);
            }

            $item = [
                'meeting_id' => $meetingId,
                'attendee_id' => $attendeeId,
                'type' => $request->get('type'),
                'vote' => 0,
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
            $itemId = $request->get('itemId');
            $attendeeId = $request->get('attendeeId');
            $value = $request->get('voteValue');

            if ($value === "true") {
                $value = true;
            } else {
                $value = false;
            }

            // update vote relation of item and attendee before updating total vote of item
            $result = $this->itemRepo->vote($itemId, $attendeeId, $value);
            if ($result === true) {
                $result = $this->itemRepo->updateTotalVote($itemId, $value);
            }

            return response()->json($result, 200);

        } catch (Exception $e) {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }

    public function edit(Request $request)
    {
        try {
            $itemId = $request->get('itemId');
            $attendeeId = $request->get('attendeeId');
            if (!$this->attendeeRepo->doesAttendeeExist($attendeeId)) {
                return response()->json(['message' => 'attendee does not exist'], 500);
            }

            $content = $request->get('content');
            if (empty($content)) {
                return response()->json(['message' => 'item content is empty'], 500);
            }
            $result = $this->itemRepo->updateItemContent($itemId, $content);
            return response()->json($result, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function remove(Request $request)
    {
        try {
            $itemId = $request->get('itemId');
            $attendeeId = $request->get('attendeeId');
            if (!$this->attendeeRepo->doesAttendeeExist($attendeeId)) {
                return response()->json(['message' => 'attendee does not exist'], 500);
            }

            $result = $this->itemRepo->remove($itemId);
            if ($result === 0) {
                return response()->json(['message' => 'Item does not exist'], 400);
            }

            return response()->json($result, 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
