<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class ProductStoreRequest extends FormRequest
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
        $ifUserid =  ((Request::get('product_id'))? Request::get('product_id') : "");
        return [
            'title' => 'required|unique:products,title,'.$ifUserid,
            'description' => 'required',
            'code' => 'required',
        ];
    }
}
