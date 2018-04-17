<?php

namespace App\Http\Requests;

use App\Rules\IsIsbn13;
use Illuminate\Validation\Rule;

/**
 * @property-read int $author_id
 * @property-read int $genre_id
 * @property-read string $isbn
 * @property-read string $title
 * @property-read string $lang
 */

class UpdateBookRequest extends CreateBookRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'isbn'      => [
                'required',
                'string',
                new IsIsbn13,
                Rule::unique('books', 'isbn')
                    ->whereNotIn('id', [$this->route('book')->id])
            ],
        ]);
    }
}
