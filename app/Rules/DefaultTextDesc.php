<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Config;

class DefaultTextDesc implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $defaultData = Config::get('staticData.vulnerabilityDefaultData');
        $defaultData = str_replace( array( "\t","\n" ), ' ', $defaultData );
        $value = str_replace( array("\t","\r\n"), ' ', $value );

        return $value !== $defaultData;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You cannot submit demo text. Clarify your context.';
    }
}
