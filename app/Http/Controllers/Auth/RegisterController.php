<?php

namespace App\Http\Controllers\Auth;

use App\Notifications\SignupActivate;
use App\User;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Throwable;

class RegisterController extends Controller
{
//    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';


    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     * @throws Exception
     */
    public function register(Request $request)
    {
        try {
            $payload = $request->all();
            $this->validator($payload)->validate();

            if ($this->doesUserExist($payload['email']) === true) {
                return response()->json(['message' => 'This email was register before!'], 500);
            }

            $user = $this->create($request->all());
            $user->notify(new SignupActivate($user));

            return response()->json(['message' => 'Successfully created user!'], 200);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Something went wrong'], 500);
        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function activateAccount(Request $request)
    {
        try {
            $token = $request->input('token');
            $user = User::where('activation_token', $token)->first();

            if (!$user) {
                return response()->json(['message' => 'This activation token is invalid.'], 500);
            }
            $user->active = true;
            $user->activation_token = '';
            $user->save();

            return response()->json(['message' => 'Congrats! Your account has been activated!'], 200);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Something went wrong!'], 500);
        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     * @throws Exception
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'activation_token' => str_random(60)
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param string $email
     * @return bool
     */
    protected function doesUserExist(string $email): bool
    {
        if (User::where('email', $email)->first() === null) {
            return false;
        }
        return true;
    }
}
