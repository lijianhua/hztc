<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateAdSpaceRequest extends Request
{
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
      'title'          => 'required|max:255',
      'description'    => 'required|max:1024',
      'address_id'     => 'required|exists:addresses,id',
      'street_address' => 'required|max:1024',
      'detail'         => 'required',
      'avatar'         => 'image',
      'type'           => 'required|integer|in:0,1,2,3',
      '__images'       => 'required|array',
      'category_ids'   => 'array',
      'ad_prices'      => 'required|array',
    ];
  }
}
