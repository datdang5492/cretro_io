<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Notifications\PasswordResetRequest;
use App\Notifications\PasswordResetSuccess;
use App\User;
use App\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Throwable;

class PasswordResetController extends Controller
{

    const PASSWORD_RESET_LINK_TIMEOUT = 20; // minutes

    /**
     * Create token password reset
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|string|email',
            ]);
            $user = User::where('email', $request->email)->first();

            if (!$user) {
                return response()->json(['message' => "We can't find a user with that e-mail address."], 500);
            }

            $passwordReset = PasswordReset::updateOrCreate(
                ['email' => $user->email],
                [
                    'email' => $user->email,
                    'token' => str_random(60),
                ]
            );
            if ($user && $passwordReset) {
                $user->notify(
                    new PasswordResetRequest($passwordReset->token)
                );
            }

            return response()->json(['message' => 'Please check your email to reset password!'], 200);

        } catch (Throwable $e) {
            return response()->json(['message' => "Something wrong happened!"], 500);
        }
    }

    /**
     * Reset password
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reset(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required|alpha_num|confirmed',
                'token' => 'required|alpha_num'
            ]);

            $passwordReset = PasswordReset::where([
                ['token', $request->token],
                ['email', $request->email]
            ])->first();

            if (empty($passwordReset)) {
                return $this->response('This password reset token is invalid.', 500);
            }

            // check timeout
            if (Carbon::parse($passwordReset->updated_at)->addMinutes(self::PASSWORD_RESET_LINK_TIMEOUT)->isPast()) {
                $passwordReset->delete();
                return $this->response('Your token was expired.', 500);
            }

            $user = User::where('email', $passwordReset->email)->first();
            if (empty($user)) {
                return $this->response("We can't find an user with that e-mail address.", 500);
            }

            $user->password = Hash::make($request->password);
            $user->save();
            $passwordReset->delete();
            $user->notify(new PasswordResetSuccess($passwordReset));

            return $this->response('Your password has been reset!', 200);
        } catch (Throwable $e) {
            return response()->json(['message' => "Something wrong happened!"], 500);
        }
    }

    private function response(string $msg, int $httpCode) {
        return response()->json(['message' => $msg], $httpCode);
    }
}
