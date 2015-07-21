<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateSlideItemRequest extends Request
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
      'picture' => 'image|max:5000',
      'url'     => 'max:1024',
      'note'    => 'max:1024',
      'sort'    => 'required|integer|min:0'
    ];
  }
}
