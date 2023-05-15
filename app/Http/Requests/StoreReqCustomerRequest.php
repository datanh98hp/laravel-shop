<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReqCustomerRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required|max:10',
            'email'=>'required|email',
            'message'=>'required|max:200'
        ];
    }
    public function messages()
{
    return [
        'name.required' => 'Tên không được bỏ trống',
        'name.max' =>'Độ dài tối đa 10 kí tự',
        'email.email'=>'Vui lòng đúng định dạng một email',
        'email.required' => 'Email không được bỏ trống',
        'message.required'=> 'Thông điệp không được trống',
        'message.max' =>'Độ dài tối đa 200 kí tự',

    ];
}
}
