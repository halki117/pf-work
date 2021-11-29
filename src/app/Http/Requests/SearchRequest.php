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
            'range_time' => 'required',
            'range_distance' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'latitude.required' => '基準となる場所を決めてください',
            'range_time.required' => '基準からの徒歩時間を決めてください',
            'range_distance.required' => '基準からの距離を決めてください',
        ];
    }

}
