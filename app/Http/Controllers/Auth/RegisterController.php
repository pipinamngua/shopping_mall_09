<?php

namespace App\Http\Controllers\Auth;

use App\Model\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Repositories\InterfaceRepository\UserInterfaceRepository;
use Illuminate\Support\Str;
use Mail;
use Session;
use App\Mail\verifyEmail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $userRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserInterfaceRepository $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Session::flash('status', 'Registered! but verify your email to activate your account');
        $user =  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verify_token' => Str::random(40),
        ]);
        $thisUser = $this->userRepository->getFindOrFail($user->id);
        $this->sendEmail($thisUser);

        return $user;
    }

    public function sendEmail($thisUser)
    {
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));
    }

    public function sendEmailDone($email, $verifyToken)
    {
        $user = $this->userRepository->getUser(['email' => $email, 'verify_token' => $verifyToken]);
        if ($user) {
            $this->userRepository->updateStatus(
                ['email' => $email, 'verify_token' => $verifyToken],
                ['status' => '1', 'verify_token' => null]
            );
            return redirect()->route('login');
        } else {
            return 'user not found';
        }
    }
}
