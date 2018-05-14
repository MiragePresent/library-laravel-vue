<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;

class BookController extends Controller
{
    public function index()
    {
        return Book::ordered()->get();
    }

    public function store(CreateBookRequest $request)
    {
        return Book::create($request->only([
            'author_id',
            'genre_id',
            'isbn',
            'title',
            'lang',
        ]));
    }

    public function show(Book $book)
    {
        return $book->toArray();
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->only([
            'author_id',
            'genre_id',
            'isbn',
            'title',
            'lang',
        ]));
        return $book->toArray();

    }

    public function destroy(Book $book)
    {
        \DB::transaction(function () use ($book){
            return $book->delete();
        });
        return response('', 204);
    }
}
