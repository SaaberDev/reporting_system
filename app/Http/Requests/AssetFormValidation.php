<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssetFormValidation extends FormRequest
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
            'companyName' => 'required',
            'companyLogo' => 'nullable|image|mimes:jpeg,png,jpg',
            'startDate' => 'required',
            'endDate' => 'required',
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'companyName.required' => 'Company name cannot be blank',
            'startDate.required' => 'Please choose a Start Date for the event',
            'endDate.required' => 'Please choose a End Date for the event',
            'url.required' => 'Base URL required',
        ];
    }
}
