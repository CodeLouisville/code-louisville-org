<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentors extends Model
{
    protected $table = 'mentors';

    protected $fillable = [
        'first',
        'last',
        'active',
        'linkedin',
        'github',
        'github_id',
        'twitter',
        'track',
        'night'
    ];
}
