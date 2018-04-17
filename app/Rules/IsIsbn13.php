<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Isbn\Isbn;

class IsIsbn13 implements Rule
{

    /** @var \Isbn\Isbn $isbn */
    private $isbn;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->isbn = new Isbn();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     * @throws \Isbn\Exception
     */
    public function passes($attribute, $value)
    {
        return $this->isbn->validation->isbn13($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not ISBN-13 code';
    }
}
