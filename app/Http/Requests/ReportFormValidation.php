<?php

namespace App\Http\Requests;

use App\Rules\DefaultTextDesc;
use Illuminate\Foundation\Http\FormRequest;

class ReportFormValidation extends FormRequest
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
            'RadioAsset' => 'required',
            'RadioWeakness' => 'required_without:otherWeakness',
            'otherWeakness' => 'required_without:RadioWeakness',
            'cvssStatic' => 'required_without:cvssOptional',
            'cvssOptional' => 'required_without:cvssStatic',
            'title' => 'required',
            'desc' => [new DefaultTextDesc()],
            'impact' => [new DefaultTextDesc()],
            'reproduce' => [new DefaultTextDesc()],
            'exploitation' => [new DefaultTextDesc()],
            'fixation' => [new DefaultTextDesc()],
        ];
    }

    /**
     * Get validation messages that apply to the rules.
     * @return array
     */
    public function messages()
    {
        return [
            'RadioAsset.required' => 'You must choose an asset from the given list.',
            'RadioWeakness.required_without' => 'Weakness information cannot be empty',
            'cvssStatic.required_without' => 'Threat level information cannot be empty',
            'title.required' => 'Bug Name Required',
        ];
    }
}
