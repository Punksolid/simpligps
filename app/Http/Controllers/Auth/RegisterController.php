<?php

namespace App\Http\Controllers\Auth;

use App\PasswordReset;
use App\User;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use http\Env\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     *
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
     * @param array $data
     *
     * @return \App\User
     *
     * @deprecated Usuarios no pueden crear cuentas por si mismos
     */
//    protected function create(array $data)
//    {
//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//        ]);
//    }

    /**
     * Para continuar el registro es básicamente un reset del password y algunos datos de usuario en el mismo request,
     * el usuario ya fue creado al crear la cuenta, sin embargo no sabemos la contraseña.
     */
    public function continueRegistration()
    {
        $this->validate(request(), [
            'email' => 'required',
            'hash' => 'required',
            'password' => 'required',
            'name' => 'required',
        ]);

        $email = request('email');
        $hash = request('hash');

        $password_reset = PasswordReset::whereEmail($email)->first();

        if (Hash::check($hash, $password_reset->token)) {
            $user = User::whereEmail($email)->first();
            $user->name = request('name');
            $user->password = bcrypt(request('password'));
            $user->email_verified_at = Carbon::now()->toDateTimeString();
            if ($user->save()) {
                return response()->json(['message' => 'You can now login.']);
            }
        } else {
            return \response(['message' => 'Invalid Token'], 422);
        }

        throw new \Exception('Something happened on new registration');
    }
}
