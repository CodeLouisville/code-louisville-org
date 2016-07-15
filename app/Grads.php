<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Grads extends Model
{
    protected $table = 'grads';
    protected $appends = array('cohorts', 'cohort_month', 'cohort_year', 'cohort_datetime');

    protected $fillable = [
        'name',
        'email',
        'linkedin',
        'github',
        'cohort_date',
        'front_end',
        'full_stack_js',
        'php',
        'dot_net',
        'rails',
        'ios',
        'android'
    ];

    protected $casts = [
        'front_end' => 'integer',
        'full_stack_js' => 'integer',
        'php' => 'integer',
        'dot_net' => 'integer',
        'rails' => 'integer',
        'ios' => 'integer',
        'android' => 'integer'
    ];

    public function getCohortDateAttribute($value)
    {
        $c = new Carbon($value);
        return $c->format('F Y');
    }

    public function getCohortDateTimeAttribute($value)
    {
        $c = new Carbon($this->attributes['cohort_date']);
        return $c;
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
        if($this->rails) array_push($cohorts, 16);
        if($this->ios) array_push($cohorts, 32);
        if($this->android) array_push($cohorts, 64);

        $cohorts_ = $this->permute($cohorts);

        return '|'.implode('|', $cohorts_).'|';
    }

    private function permute($set)
    {
        $additions = array();

        for($i = 0; $i < pow(2, count($set)); $i++){
            $sum = 0;
            for($j = count($set)-1; $j >= 0; $j--) {
                if(pow(2, $j) & $i) {
                    $sum += $set[$j];
                }
            }
            $additions[] = (string)$sum;
        }

        sort($additions);

        return $additions;
    }
}
