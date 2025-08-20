<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class FocusKeywordMaxRule implements Rule
{
    protected $maxWords;

    public function __construct($maxWords)
    {
        $this->maxWords = $maxWords;
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
        return str_word_count($value) <= $this->maxWords;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The :attribute must not contain more than {$this->maxWords} words.";
    }
}
