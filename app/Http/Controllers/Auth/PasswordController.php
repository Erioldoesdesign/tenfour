<?php

namespace TenFour\Http\Controllers\Auth;

use TenFour\Http\Controllers\Controller;
use TenFour\Models\User;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postEmail(Request $request)
    {
        $this->validate($request, ['username' => 'required|email']);

        $user = User::leftJoin('organizations', 'users.organization_id', '=', 'organizations.id')
            ->leftJoin('contacts', 'contacts.user_id', '=', 'users.id')
            ->where('organizations.subdomain', '=', $request->input('subdomain'))
            ->where('contacts.contact', '=', $request->input('username'))
            ->first();

        if (!$user || !isset($user['person_type']) || $user['person_type'] !== 'user') {
            return response('', 403);
        }

        $response = Password::sendResetLink($request->only('username', 'subdomain'), function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return response('ok', 200);

            default:
                return response('', 403);
        }
    }

    /**
     * Reset the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postReset(Request $request)
    {
        $this->validate($request, [
            'token' => 'required',
            'username' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $credentials = $request->only(
            'username', 'subdomain', 'password', 'password_confirmation', 'token'
        );

        $response = Password::reset($credentials, function ($user, $password) {
            $user->forceFill([
              'password' => $password,
            ])->save();
        });

        switch ($response) {
            case Password::PASSWORD_RESET:
                return response('ok', 200);

            default:
                return response('', 403);
        }
    }

}
