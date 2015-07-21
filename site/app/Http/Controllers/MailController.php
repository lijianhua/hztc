<?php namespace App\Http\Controllers;
use Redirect;
use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
class MailController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
    $active_token = $_GET['active_token'];
    $user = User::where('active_token','=', $active_token)->first();
    $user_time = strtotime($user->updated_at);
    $now = time();
    if(3600 < ($now-$user_time) )
    {
       $re_active_token = hash_hmac('sha256', str_random(40),'re_activing');
       $affectedrows = User::where('active_token','=', $active_token)->update(['active_token' => $re_active_token]);
       return Redirect::to('auth/email/'.$user->id);
    }
    else
    {
      $affectedrows = User::where('active_token','=', $active_token)->update(['confirmed' => 1]);
      Auth::login($user);
      return Redirect::to('/');
    }
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
    $user = User::find($id);
    $data = ['email' => $user->email, 'name' => $user->name, 'active_token' => $user->active_token];
    if($user->confirmed == 1)
    {
      Auth::login($user);
      return Redirect::to('/');
    }
    else
    {
      Mail::queue('emails.active',  $data, function($message) use($data)
      {
          $message->to($data['email'], $data['name'])->subject('欢迎注册我们的网站，请激活您的账号！');
      });
      return view('emails/email', compact('data'));
    }
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
