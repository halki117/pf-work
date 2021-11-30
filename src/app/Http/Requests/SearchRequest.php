<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
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
            'latitude' => 'required',
            'longitude' => 'required',
            'range_time' => 'required_without:range_distance|integer',
            'range_distance' => 'integer',
        ];
    }

    public function messages()
    {
        return [
            'latitude.required' => '基準となる場所を決めてください',
            'range_time.required_without' => '基準からの徒歩時間、もしくは距離を入力してください',
            'range_time.integer' => '半角数字で入力してください',
            'range_distance.integer' => '半角数字で入力してください',
        ];
    }

}
