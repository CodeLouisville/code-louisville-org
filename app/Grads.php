<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Grads extends Model
{
    protected $table = 'grads';
    protected $appends = array('cohorts');

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

    public function getCohortsAttribute()
    {
        $cohorts = '';

        if($this->front_end) $cohorts .= ' front-end';
        if($this->full_stack_js) $cohorts .= ' js';
        if($this->php) $cohorts .= ' php';
        if($this->dot_net) $cohorts .= ' net';

        return $cohorts;
    }
}
