<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
        $yesterday = Carbon::yesterday();
        return [
            'companyName' => 'required',
            'companyLogo' => 'nullable|image|mimes:jpeg,png,jpg',
            'startDate' => "required|after:$yesterday",
            'endDate' => 'required|after:startDate',
            'url' => ['required', 'regex:/www\.|https?:\/\/(?:www\.|(?!www))/'] ,
            'ios' => ['nullable', 'regex:/www\.|https?:\/\/(?:www\.|(?!www))/'],
            'android' => ['nullable', 'regex:/www\.|https?:\/\/(?:www\.|(?!www))/'],
            'inScopeUrl' => 'required',
            'outScopeUrl' => 'nullable',
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
            'companyName.required' => 'Company name is required',
            'startDate.required' => 'Please choose a Start Date for the event',
            'startDate.after_or_equal' => 'You cannot create a past event',
            'endDate.required' => 'Please choose a End Date for the event',
            'endDate.after' => 'You cannot create an event for the same or before the starting date',
            'url.required' => 'Base URL required',
            'url.regex' => 'Must use http:// or https:// for any kind of URL',
            'ios.regex' => 'Must use http:// or https:// for any kind of URL',
            'android.regex' => 'Must use http:// or https:// for any kind of URL',
            'inScopeUrl.required' => 'In Scope Url URL required',
        ];
    }
}
