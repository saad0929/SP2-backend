<?php

namespace App\Http\Requests\BookLend\BookLendRequest;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookLendRequest extends FormRequest
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
            'user_id' => 'required',
            'book_id' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'user_name' => 'required',
            'book_name' => 'required'
        ];
    }
}
