<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpotRequest extends FormRequest
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
            'address' => 'required',
            'review' => 'required|max:500',
            'image' => 'required',
            'image.*' => 'required|mimes:jpg, png, gif, tif',
            'public' => 'required',
            'tags' => 'json|regex:/^(?!.*\s).+$/u|regex:/^(?!.*\/).*$/u',
        ];
    }

    public function messages()
    {
        return [
            'address.required' => '所在地は必須です',
            'review.required' => 'レビューは必須です',
            'image.required' => '画像は必須です',
            'image.*.mimes' => '画像の拡張子が対応していません',
        ];

    }

    public function passedValidation()
    {
        $this->tags = collect(json_decode($this->tags))
        ->slice(0.5)
        ->map(function($requestTag){
            return $requestTag->text;
        });
    }
}
