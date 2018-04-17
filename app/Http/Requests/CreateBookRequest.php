<?php

namespace App\Http\Requests;

use App\Rules\IsIsbn13;
use App\Rules\IsoLangCode;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property-read int $author_id
 * @property-read int $genre_id
 * @property-read string $isbn
 * @property-read string $title
 * @property-read string $lang
 */

class CreateBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->json();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'author_id' => 'required|numeric|exists:authors,id',
            'genre_id'  => 'required|numeric|exists:genres,id',
            'title'     => 'required|string|max:255',
            'isbn'      => [
                'required',
                new IsIsbn13,
                'unique:books,isbn',
            ],
            'lang'      => [
                'required',
                'string',
                new IsoLangCode,
            ],
        ];
    }
}
