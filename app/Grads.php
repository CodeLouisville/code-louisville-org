<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Grads extends Model
{
    protected $table = 'grads';

    protected $fillable = [
        'name',
        'email',
        'linkedin',
        'github',
        'cohort_date',
        'front_end',
        'full_stack_js',
        'php',
        'dot_net'
    ];

    public function getCohortdateAttribute($value)
    {
        $c = new Carbon($value);
        return $c->format('F Y');
    }
}
