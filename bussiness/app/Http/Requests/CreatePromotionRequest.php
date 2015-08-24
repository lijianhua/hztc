<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreatePromotionRequest extends Request
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
      'ad_space_id' => 'required|integer',
      'title'       => 'required|max:255',
      'stock'       => 'required|integer|min:0',
      'price'       => 'required|numeric|min:0',
      'start'       => 'required|date',
      'end'         => 'required|date|after:now'
    ];
  }
}
