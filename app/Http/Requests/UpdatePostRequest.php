<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $post = $this->route('post');
//        dd($this);
        return [
            'title'        => [
                'required',
                'string',
                Rule::unique('posts', 'title')->ignore($post->id)
            ],
            'slug'         => [
                'required',
                'string',
                Rule::unique('posts', 'slug')->ignore($post->id)
            ],
            'content'      => 'required|string',
            'categories'   => 'array',
            'categories.*' => "string|nullable|distinct|exists:categories,id",
            'thumbnail'    => 'file|mimes:png,jpg,gif|max:2097152'
        ];
    }
}
