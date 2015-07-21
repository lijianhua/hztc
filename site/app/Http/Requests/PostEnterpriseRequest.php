<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class PostEnterpriseRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			//
      'truthname' => 'required',
      'idcard'   => 'required|regex:/^\d{17}[\dX]{1}$/',
      'telphone'  => 'required|regex:/^\d{11}$/',
      'enterprise' => 'required|max:255'
		];
	}

}
