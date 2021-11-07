<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Http;

class ValidUrl implements Rule
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
        return $this->isValidUrl($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Url you provided is invalid or does not exists!');
    }

    private function isValidUrl($url) {
        $url = parse_url($url);

        if (!isset($url["host"])) return false;
        if ($url['host'] == '127.0.0.1' || $url['host'] == 'localhost') return true;
        return !(gethostbyname($url["host"]) == $url["host"]);
    }
}
