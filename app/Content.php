<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    protected $table = 'content';

    protected $fillable = [
        'key', 'group', 'content'
    ];

    public function setContentAttribute($value)
    {
        $this->attributes['content'] = preg_replace('/\s\s+/', '', $value);
    }
}
