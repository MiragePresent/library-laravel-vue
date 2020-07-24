<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 *  Author model
 *
 * @property int $id
 * @property string $name
 * @property-read  string $short_name Name in format Surname N. (N => Name)
 *
 */

class Author extends Model
{

    protected $fillable = [
        'name'
    ];

    /**
     *  Disable timestamps
     * @var bool
     */
    public $timestamps = false;

    // ACCESSORS

    /**
     * @param $name
     * @return string
     */
    public function getShortNameAttribute($name)
    {
        return collect(explode(' ', $name))->map(function ($name_part, $index) {
            return !$index ?  $name_part : strtoupper($name_part[0]);
        })->implode(' ');
    }
}
