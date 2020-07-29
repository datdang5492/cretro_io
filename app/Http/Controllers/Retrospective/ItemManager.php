<?php

namespace App\Http\Controllers\Retrospective;

use App\Events\ItemCreatedEvent;
use App\Events\ItemUpdatedEvent;
use App\Events\ItemVotedEvent;
use App\Http\Controllers\Controller;
use App\Http\Repositories\Attendee;
use App\Http\Repositories\Item;
use App\Http\Repositories\Meeting;
use Exception;
use Illuminate\Http\Request;

class ItemManager extends Controller
{

    const GOOD_ITEM = 0;
    const BAD_ITEM = 1;
    const ACTION_ITEM = 2;
    const APPRECIATION_ITEM = 3;

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
                'appreciations' => []
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
                if ($item->type === self::GOOD_ITEM) {
                    $results['goods'][] = $ticket;
                } else if ($item->type === self::BAD_ITEM) {
                    $results['bads'][] = $ticket;
                } else if ($item->type === self::ACTION_ITEM) {
                    $results['ideas'][] = $ticket;
                } else if ($item->type === self::APPRECIATION_ITEM) {
                    $results['appreciations'][] = $ticket;
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
            $item['id'] = $id;
            $item['isVoted'] = false;

            event(new ItemCreatedEvent($item, $meetingId));

            return response()->json('Success', 200);

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

            // update vote relation of item and attendee before updating total vote of item
            $result = $this->itemRepo->vote($itemId, $attendeeId, $value);
            if ($result === false) {
                throw new Exception("Something wrong happened!");
            }

            if ($this->itemRepo->updateTotalVote($itemId, $value)) {
                $totalVote = $this->itemRepo->getItemTotalVote($itemId);

                event(new ItemVotedEvent([
                    'id' => $itemId,
                    'type' => $request->get('type'),
                    'vote' => $totalVote
                ], $request->get('meetingId')));
            }

            return response()->json($result, 200);

        } catch (Exception $e) {
            dd($e->getMessage());
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

            event(new ItemUpdatedEvent([
                'id' => $itemId,
                'type' => $request->get('type'),
                'content' => $content
            ], $request->get('meetingId')));

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
