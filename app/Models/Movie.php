<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    //
    protected $fillable = [
        'title',
        "type",
        'release_year',
        'rating',
        'description',
        'poster'
    ];

    public function watchlists()
    {
        return $this->hasMany(WatchList::class);
    }
}
