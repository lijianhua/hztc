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
    $email = $_GET['active_token'];
    $affectedrows = User::where('email','=', $email)->update(['confirmed' => 1]);
    $user = User::where('email','=', $email)->first();
    Auth::login($user);
    return Redirect::to('/');
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
    $data = ['email' => $user->email, 'name' => $user->name];

    Mail::send('emails.active',  $data, function($message) use($data)
    {
        $message->to($data['email'], $data['name'])->subject('欢迎注册我们的网站，请激活您的账号！');
   });
   return view('emails/email', compact('data'));
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
