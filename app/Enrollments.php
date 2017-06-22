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
            'email',
            'msgphone',
            'birthdate',
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
            'codelouenrolleduniv',
            'codelouwhatunivdegree',
            'codeloucodeofconduct'
    ];
}
