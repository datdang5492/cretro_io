<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Http\Repositories\Attendee;
use App\Http\Repositories\Meeting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $userId = Auth::id();
            $meetings = $this->meetingRepo->getUserMeetingList($userId);
            return response()->json(['data' => $meetings], 200);

        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
