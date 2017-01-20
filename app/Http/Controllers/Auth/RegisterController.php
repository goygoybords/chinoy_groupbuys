<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Customer;
use Mail;
use App\Mail\UserMailAuthentication;

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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
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
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'email' => 'required|email|max:255|unique:users',
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'contact_number' => 'required',
            'shipping_address' => 'required',
            'city' => 'required',
            'zip' => 'required',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'isAdmin' => 0,
            'status' => 0
        ]);
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        $customer = new Customer($request->all());
        $user->addCustomer($customer, $user);
        Mail::to($user->email)->send(new UserMailAuthentication($user));
        return back()->with(flash("Please Confirm Your Emaill Address", "alert-warning"));

        // https://www.youtube.com/watch?v=aOaSZr-_uf4 email tutorial link
    }

    public function confirmEmail($token)
    {
        echo $token;
        die();
        $user = User::where("token", $token)->firstOrFail()
            ->updateStatus();

        
        return redirect('/login')->with(flash("Email is confirmed. Please Login", "alert-success"));
    }

   
}
