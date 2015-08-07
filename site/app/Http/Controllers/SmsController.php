<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\REST;
use App\Models\SMSRepository;
use Queue;
use Session;
class SmsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function message(Request $request)
	{
      $sendMessage = new SMSRepository();
      $message = rand(100000, 999999);
      Session::put('message', $message);
      Session::put('phone', $request->get('phone'));
      $data = array($message, '1');
      $sendMessage->sendQueueScoreGainedMessage(trim($request->get('phone')),$data,'27854');
      return array('message'=>$message, 'phone'=>$request->get('phone'));
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
		//
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
