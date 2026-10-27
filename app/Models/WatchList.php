<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WatchList extends Model
{
    protected $table = 'watchlists';
    
    protected $fillable = ['device_id', 'movie_id'];

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}