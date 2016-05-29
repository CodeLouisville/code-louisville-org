<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Grads extends Model
{
    protected $table = 'grads';
    protected $appends = array('cohorts', 'cohort_month', 'cohort_year');

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

    protected $casts = [
        'front_end' => 'integer',
        'full_stack_js' => 'integer',
        'php' => 'integer',
        'dot_net' => 'integer'
    ];

    public function getCohortDateAttribute($value)
    {
        $c = new Carbon($value);
        return $c->format('F Y');
    }

    public function setCohortDateAttribute($value)
    {
        $c = new Carbon("first day of $value", 'America/Louisville');
        $this->attributes['cohort_date'] = $c;
    }

    public function getCohortMonthAttribute($value)
    {
        $c = new Carbon($this->attributes['cohort_date']);
        return $c->format('F');
    }

    public function getCohortYearAttribute($value)
    {
        $c = new Carbon($this->attributes['cohort_date']);
        return $c->format('Y');
    }

    public function getCohortsAttribute()
    {
        $cohorts = [];

        if($this->front_end) array_push($cohorts, 1);
        if($this->full_stack_js) array_push($cohorts, 2);
        if($this->php) array_push($cohorts, 4);
        if($this->dot_net) array_push($cohorts, 8);

        if(count($cohorts) == 4)
        {
            array_push($cohorts, $cohorts[0] + $cohorts[1]);
            array_push($cohorts, $cohorts[0] + $cohorts[2]);
            array_push($cohorts, $cohorts[0] + $cohorts[3]);
            array_push($cohorts, $cohorts[1] + $cohorts[2]);
            array_push($cohorts, $cohorts[1] + $cohorts[3]);
            array_push($cohorts, $cohorts[2] + $cohorts[3]);
            array_push($cohorts, $cohorts[0] + $cohorts[1] + $cohorts[2]);
            array_push($cohorts, $cohorts[0] + $cohorts[1] + $cohorts[3]);
            array_push($cohorts, $cohorts[0] + $cohorts[2] + $cohorts[3]);
            array_push($cohorts, $cohorts[1] + $cohorts[2] + $cohorts[3]);
            array_push($cohorts, $cohorts[0] + $cohorts[1] + $cohorts[2] + $cohorts[3]);
        }

        if(count($cohorts) == 3)
        {
            array_push($cohorts, $cohorts[0] + $cohorts[1]);
            array_push($cohorts, $cohorts[0] + $cohorts[2]);
            array_push($cohorts, $cohorts[1] + $cohorts[2]);
            array_push($cohorts, $cohorts[0] + $cohorts[1] + $cohorts[2]);
        }

        if(count($cohorts) == 2)
        {
            array_push($cohorts, $cohorts[0] + $cohorts[1]);
        }

        return implode($cohorts, ',');
    }
}
