<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'slug'];

    // public function setSlugAttribute() {
    //     $this->attributes['slug'] = Str::slug(mb_substr($this->title, 0, 40), '-');
    // }
}
