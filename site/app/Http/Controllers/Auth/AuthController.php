<?php namespace App\Http\Controllers\Auth;
use Auth;
use Redirect;
use App\Models\User;
use App\Models\RandCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Http\Middleware\BeforeLoginMiddleware;
use App\Models\ValiCodeRepository;
use Session;
use App\Models\UserInformation;
use DB;
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

    $this->middleware('guest', ['except' => ['getLogout', 'verify']]);
  }
    public function postLogin(Request $request) { $this->validate($request, [
      'phone' => 'required', 
      'password' => 'required', 
      'captcha' => 'required|captcha'],
      [
      'password.required' => '密码不能为空', 
      'captcha.captcha' => '验证码错误',
      'captcha.required' => '验证码不能为空'
      ]);

		$credentials = $request->only('phone', 'password');

		if ($this->auth->attempt($credentials, $request->has('remember')))
		{
			return redirect()->intended($this->redirectPath());
		}

		return redirect($this->loginPath())
					->withInput($request->only('phone', 'remember'))
					->withErrors([
					//	'email' => $this->getFailedLoginMessage(),
          '密码错误',
					]);
	}
	public function getRegister()
  {
    if(Session::has('message')&&Session::has('phone'))
    {
      $message = Session::get('message');
      $phone = Session::get('phone');
      return view('/auth/register')->with(compact('message', 'phone'));
    }
    return view('/auth/register');
  }
	public function postRegister(Request $request)
	{
		$this->validate($request, [
			'name' => 'required|max:255|min:6|alpha_dash',
			'email' => 'required|email|max:255|unique:users',
      'captcha' => 'required',
      //'phone_code' => 'required|phonecode',
      'phone' => 'required|tel|unique:users',
			'password' => 'required|confirmed|min:6'],
      [ 'email.required'=> '邮箱不能为空', 
        'email.unique'=> '邮箱已经存在', 
        'phone.unique'=> '手机号已经存在', 
        'name.required'=> '用户名不能为空', 
        'name.min'=> '用户名不能少于六位', 
        'name.max'=> '用户名超出范围', 
        'name.alpha_dash'=> '用户名含有特殊字符', 
        'password.required' => '密码不能为空', 
        'password.confirmed' => '两次密码不匹配', 
        'captcha.required' => '验证码不能为空',
        'phone_code.required' => '手机短信码不能为空',
        'phone_code.phonecode' => '手机短信码错误',
        'phone.required' => '手机号不能为空',
        'phone.tel' => '手机格式错误'
      ]);
    $name = $request->get('name');
    $email = $request->get('email');
    $pwd = bcrypt($request->get('password'));
    $user_id = 0;
    if ($request->has('reference'))
    {
      $user_id = User::where('user_code', '=', $request->get('reference'))
        ->first()->id;
    }
    $user_code = RandCode::first();
    $active_token = hash_hmac('sha256', str_random(40),'activing');
	  $user =  User::create([
			'name' => $name,
			'email' => $email,
      'password' => $pwd,
      'active_token' => $active_token,
      'phone' => $request->get('phone'),
      'user_id' => $user_id,
      'user_code' => $user_code->nonce,
      'user_type' => '普通用户',
      'progress' => '',
		]);
	  UserInformation::create([
			'user_id' => $user->id,
			'start_time' => date("Y/m/d"),
			'end_time' => date("Y/m/d"),
      'vipnum' => 0, 
      'city' => '',
      'burnish' => 0,
      'clinic' => 0,
      'rshow' => 0,
      'authority' => 0 
		]);
    $user_code->delete();
//    return Redirect::to('auth/email/'.$user->id);
    Auth::login($user);
    return Redirect::to('/');
	}

  public function verify()
  {
    $status = 'error';

    if (Auth::check() && Auth::user()->is_verify == 1) {
      $status = 'ok';
    }

    return response()->json(['status' => $status]);
  }
}
