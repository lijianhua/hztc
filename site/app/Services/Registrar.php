<?php namespace App\Services;
use Mail;
use App\Models\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
    $active_token = bcrypt($data['email']);
    $name = $data['name'];
    $email = $data['email'];
    $pwd = bcrypt($data['password']);
	  $user =  User::create([
			'name' => $name,
			'email' => $email,
			'password' => $pwd 
		]);
    return $user;
//    $uid = $user->id;
//    $data = ['name'=>$name, 'email'=>$email, 'pwd'=>$pwd, 'active_token'=>$active_token, 'uid'=>$uid];
//    Mail::send('emails.active',  $data, function($message) use($data)
//    {
//        $message->to($data['email'], $data['name'])->subject('欢迎注册我们的网站，请激活您的账号！');
//   });
	}

}
