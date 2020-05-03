<?php

namespace App\Http\Controllers\Retrospective;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class MeetingManager extends Controller
{
    public function __construct()
    {
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
        try {
            $results = [
                [
                    'id' => 0,
                    'name' => "Wahaab Bhatti",
                    'score' => 7,
                    'goodInputNo' => 2,
                    'badInputNo' => 2,
                    'actionInputNo' => 1,
                    'givenVote' => 2,
                    'isConductor' => false,
                    'isWinner' => false,
                ],
                [
                    'id' => 1,
                    'name' => "Dat Dang",
                    'score' => 7,
                    'goodInputNo' => 2,
                    'badInputNo' => 2,
                    'actionInputNo' => 1,
                    'givenVote' => 2,
                    'isConductor' => true,
                    'isWinner' => false,
                ],
                [
                    'id' => 2,
                    'name' => "Vasiliy Stepkin",
                    'score' => 7,
                    'goodInputNo' => 2,
                    'badInputNo' => 2,
                    'actionInputNo' => 1,
                    'givenVote' => 2,
                    'isConductor' => false,
                    'isWinner' => false,
                ],
                [
                    'id' => 3,
                    'name' => "Stefan Schmidhuber",
                    'score' => 7,
                    'goodInputNo' => 2,
                    'badInputNo' => 2,
                    'actionInputNo' => 1,
                    'givenVote' => 2,
                    'isConductor' => false,
                    'isWinner' => false,
                ]
            ];
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
