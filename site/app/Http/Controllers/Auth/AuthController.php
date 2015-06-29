<?php namespace App\Http\Controllers\Auth;

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
			'email' => 'required|email', 'password' => 'required', 'captcha' => 'required|captcha'],[ 'email.required'=> '邮箱不能为空' ,'password.required' => '密码不能为空', 'captcha.captcha' => '验证码错误']);

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
}
