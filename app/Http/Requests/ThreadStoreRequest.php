<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ThreadStoreRequest extends FormRequest
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
            'title'    => ['required', 'max:60', 'min:5'],
            'body'     => ['required', 'max:300', 'min:5'],
            'category' => ['required'],
            'tags'     => ['array'],
            'tags.*'   => ['exists:tags,id'],
        ];
    }
}
