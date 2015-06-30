<?php namespace App\Http\Controllers\Auth;

use Redirect;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Middleware\BeforeLoginMiddleware;
class AuthController extends Controller {
  protected $redirectTo = '/';

  /*
  |--------------------------------------------------------------------------
  | Registration & Login Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users, as well as the
  | authentication of existing users. By default, this controller uses
  | a simple trait to add these behaviors. Why don't you explore it?
  |
   */

  use AuthenticatesAndRegistersUsers;

  /**
   * Create a new authentication controller instance.
   *
   * @param  \Illuminate\Contracts\Auth\Guard  $auth
   * @param  \Illuminate\Contracts\Auth\Registrar  $registrar
   * @return void
   */
  public function __construct(Guard $auth, Registrar $registrar)
  {
    $this->auth = $auth;
    $this->registrar = $registrar;

    $this->middleware('guest', ['except' => 'getLogout']);
  }
    
	public function postLogin(Request $request)
	{
		$this->validate($request, [
      'email' => 'required|email', 
      'password' => 'required', 
      'captcha' => 'required|captcha'],
      [
      'email.required'=> '邮箱不能为空', 
      'password.required' => '密码不能为空', 
      'captcha.captcha' => '验证码错误'
      ]);

		$credentials = $request->only('email', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('email', 'remember'))
					->withErrors([
						'email' => $this->getFailedLoginMessage(),
					]);
	}
	public function postRegister(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:255|min:6|alpha_dash',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6'],
      [ 'email.required'=> '邮箱不能为空', 
        'email.unique'=> '邮箱已经存在', 
        'name.required'=> '用户名不能为空', 
        'name.min'=> '用户名不能少于六位', 
        'name.max'=> '用户名超出范围', 
        'name.alpha_dash'=> '用户名含有特殊字符', 
        'password.required' => '密码不能为空', 
        'password.confirmed' => '两次密码不匹配', 
      ]);
    $name = $request->get('name');
    $email = $request->get('email');
    $pwd = bcrypt($request->get('password'));
	  $user =  User::create([
			'name' => $name,
			'email' => $email,
			'password' => $pwd 
		]);
    return Redirect::to('auth/email/'.$user->id);
	}
}
