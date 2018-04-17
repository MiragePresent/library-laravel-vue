<?php

namespace Tests\Feature;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use App\Repositories\LanguageRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BookResourceTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function get_book_info()
    {
        /** @var |App\Models\Book $book */
        $book = factory(Book::class)->create();

        $this->json('GET', route('books.show', ['book' => $book->id]))
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'author_id',
                'genre_id',
                'isbn',
                'title',
                'lang',
                'language',
                'author' => [
                    'id',
                    'name',
                ],
                'genre' => [
                    'id',
                    'title',
                ],
            ]);
    }

    /** @test */
    public function get_list_of_books()
    {
        factory(Book::class, 10)->create();

        $this->json('GET', route('books.index'))
            ->assertStatus(200)
            ->assertJsonStructure([[
                'id',
                'author_id',
                'genre_id',
                'isbn',
                'title',
                'lang',
                'author' => [
                    'id',
                    'name',
                ],
                'genre' => [
                    'id',
                    'title',
                ],
            ]]);
    }

    /** @test */
    public function create_book_with_valid_data()
    {
        $post = [
            'author_id' => factory(Author::class)->create()->id,
            'genre_id'  => factory(Genre::class)->create()->id,
            'isbn'      => $this->faker->isbn13,
            'title'     => $this->faker->sentence,
            'lang'      => (new LanguageRepository)->random()->code,
        ];

        $this->json('POST', route('books.store'), $post)
            ->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'author_id',
                'genre_id',
                'isbn',
                'title',
                'lang',
            ]);
    }

    /** @test */
    public function create_book_with_invalid_data()
    {
        foreach ($this->invalidCreateData() as $data) {
            $this->json('POST', route('books.store'), $data['post'])
                ->assertStatus(422)
                ->assertJsonStructure(['message', 'errors' => $data['fields']]);
        }
    }

    /** @test */
    public function update_book_with_valid_data()
    {
        /** @var \App\Models\Book $book */
        $book = factory(Book::class)->create();
        $data = [
            'author_id' => factory(Author::class)->create()->id,
            'genre_id'  => factory(Genre::class)->create()->id,
            'isbn'      => $book->isbn,
            'title'     => $this->faker->sentence,
            'lang'      => (new LanguageRepository)->random()->code,
        ];

        $this->json('PATCH', route('books.update', ['book' => $book->id]), $data)
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'author_id',
                'genre_id',
                'isbn',
                'title',
                'lang',
            ]);
    }

    /** @test */
    public function update_book_with_invalid_data()
    {
        /** @var \App\Models\Book $book */
        $book = factory(Book::class)->create();
        foreach ($this->invalidUpdateData($book) as $case=>$data) {
            $this->json('PATCH', route('books.update', ['book' => $book->id]), $data['post'])
                ->assertStatus(422, "$case doesn't produce errors")
                ->assertJsonStructure(['message', 'errors' => $data['fields']]);
        }
    }

    /** @test */
    public function delete_book()
    {
        /** @var \App\Models\Book $book */
        $book = factory(Book::class)->create();

        $this->json('DELETE', route('books.destroy', ['book' => $book->id]))
            ->assertStatus(204);

        $this->assertEmpty(Book::all()->toArray());
    }

    /**
     *  Data provider
     * @return array
     */
    private function invalidCreateData()
    {
        return [
            [
                'post' => [
                    'author_id' => factory(Author::class)->create()->id,
                    'genre_id'  => factory(Genre::class)->create()->id,
                    'isbn'      => $this->faker->isbn13,
                    'title'     => $this->faker->sentence,
                    'lang'      => 'iz',
                ],
                'fields' => ['lang'],
            ],
            [
                'post' => [
                    'author_id' => factory(Author::class)->create()->id,
                    'genre_id'  => factory(Genre::class)->create()->id,
                    'isbn'      => factory(Book::class)->create()->isbn,
                    'title'     => $this->faker->sentence,
                    'lang'      => (new LanguageRepository)->random()->code,
                ],
                'fields' => ['isbn'],
            ],
            [
                'post' => [
                    'author_id' => factory(Author::class)->create()->id,
                    'genre_id'  => factory(Genre::class)->create()->id,
                    'isbn'      => $this->faker->isbn13,
                    'title'     => $this->faker->paragraph(10),
                    'lang'      => 'iz',
                ],
                'fields' => ['title'],
            ],
        ];
    }

    public function invalidUpdateData(Book $book)
    {
        return [
            'invalid_lang' => [
                'post' => [
                    'author_id' => $book->author_id,
                    'genre_id'  => factory(Genre::class)->create()->id,
                    'isbn'      => $book->isbn,
                    'title'     => $this->faker->sentence,
                    'lang'      => 'iz',
                ],
                'fields' => ['lang'],
            ],
            'invalid_isbn' => [
                'post' => [
                    'author_id' => $book->author_id,
                    'genre_id'  => $book->genre_id,
                    'isbn'      => factory(Book::class)->create()->isbn,
                    'title'     => $this->faker->sentence,
                    'lang'      => (new LanguageRepository)->random()->code,
                ],
                'fields' => ['isbn'],
            ],
            'invalid_title' => [
                'post' => [
                    'author_id' => factory(Author::class)->create()->id,
                    'genre_id'  => factory(Genre::class)->create()->id,
                    'isbn'      => $this->faker->isbn13,
                    'title'     => $this->faker->paragraph(10),
                    'lang'      => (new LanguageRepository)->random()->code,
                ],
                'fields' => ['title'],
            ],
        ];
    }
}
