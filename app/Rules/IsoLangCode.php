<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Repositories\LanguageRepository;

class IsoLangCode implements Rule
{

    /** \App\Repositories\LanguageRepositoryContract @var $langRepository */
    private $langRepository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->langRepository = new LanguageRepository();
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
        return $this->langRepository->isValid($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute is not ISO_639-1 language code';
    }
}
