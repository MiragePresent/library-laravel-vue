<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResources([
    'books' => 'BookController',
]);

Route::get('authors', function () {
    return App\Models\Author::orderBy('name')->get()->toArray();
});
Route::get('genres', function () {
    return App\Models\Genre::orderBy('title')->get()->toArray();
});
Route::get('languages', function () {
    return (new App\Repositories\LanguageRepository)
        ->all()
        ->map(function (\App\Entities\LanguageContract $lang) {
           return [
               'code'   => $lang->code,
               'title'  => $lang->title,
           ];
        })
        ->values()
        ->toArray();
});
