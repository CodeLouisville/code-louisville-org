<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enrollments extends Model
{
    protected $fillable = [
        'firstname',
        'lastname',
        'ssn',
        'address',
        'city',
        'state',
        'countycode',
        'zipcode',
        'birthdate',
        'msgphone',
        'email',
        'gender',
        'amerindian',
        'asian',
        'white',
        'black',
        'islander',
        'didnotidentifyrace',
        'hispanic',
        'primarylangeng',
        'primarylangspan',
        'citizenship',
        'veteranstatus',
        'employmentstatus',
        'uistatus',
        'disablingcondition',
        'havefelony',
        'codelouedlevel',
        'employedtech',
        'jobmainduties',
        'interestedtech',
        'jobinterest',
        'codelou_lou',
        'codelou_jeff',
        'codelou_lagrange',
        'selectiveservice',
        'codelouannualincome',
        'codelouenrolleduniv',
        'codelouwhatunivdegree',
        'codeloucat1dslwrk',
        'codeloucat1ds2wrk',
        'codeloucat1ds3wrk',
        'codeloucat1ds4wrk',
        'codeloucat1ds5wrk',
        'codelounumhouse',
        'rectanf',
        'recgeneralasst',
        'recother',
    ];
}
