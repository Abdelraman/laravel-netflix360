<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    //attributes----------------------------------
    public function getNameAttribute($value)
    {
        return ucfirst($value);

    }// end of getNameAttribute

    //relations ----------------------------------
    public function movies()
    {
        return $this->belongsToMany(Movie::class, 'movie_category');

    }// end of movies

    //scopes --------------------------------------
    public function scopeWhenSearch($query, $search)
    {
        return $query->when($search, function ($q) use ($search) {
            return $q->where('name', 'like', "%$search%");
        });

    }// end of scopeWhenSearch

}//end of model

