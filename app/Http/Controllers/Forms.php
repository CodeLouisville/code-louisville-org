<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use Mail;
use Redirect;
use Illuminate\Http\Request;
use SoapWrapper;
use App\Mentors;
use App\Grads;
use GuzzleHttp;

class Forms extends Controller
{
    protected $request;

    private $mail_from;
    private $mail_recipient;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->mail_from = env('MAIL_FROM');
        $this->mail_recipient = env('MAIL_RECIPIENT');
    }

    public function enroll()
    {
        $data = [
            'PassPhrase' => env('ENROLL_PASS'),
            'FirstName' => $this->request->input('FirstName'),
            'LastName' => $this->request->input('LastName'),
            'SSN' => $this->request->input('ssn'),
            'Address' => $this->request->input('Address'),
            'City' => $this->request->input('City'),
            'State' => $this->request->input('State'),
            'CountyCode' => $this->request->input('CountyCode'),
            'ZipCode' => $this->request->input('ZipCode'),
            'Email' => $this->request->input('Email'),
            'MsgPhone' => $this->request->input('MsgPhone'),
            'BirthDate' => $this->request->input('BirthDate'),
            'Gender' => $this->request->input('Gender'),
            'AmerIndian' => $this->request->input('AmerIndian'),
            'Asian' => $this->request->input('Asian'),
            'White' => $this->request->input('White'),
            'Black' => $this->request->input('Black'),
            'Islander' => $this->request->input('Islander'),
            'DidNotIdentifyRace' => $this->request->input('DidNotIdentifyRace'),
            'Hispanic' => $this->request->input('Hispanic'),
            'PrimaryLangEng' => $this->request->input('PrimaryLangEng'),
            'PrimaryLangSpan' => $this->request->input('PrimaryLangSpan'),
            'Citizenship' => $this->request->input('Citizenship'),
            'VeteranStatus' => $this->request->input('VeteranStatus'),
            'EmploymentStatus' => $this->request->input('EmploymentStatus'),
            'JobRateOfPay' => $this->request->input('JobRateOfPay'),
            'WagePeriod' => $this->request->input('WagePeriod'),
            'UIStatus' => $this->request->input('UIStatus'),
            'DisablingCondition' => $this->request->input('DisablingCondition'),
            'HaveFelony' => $this->request->input('HaveFelony'),
            'FelonyExplain' => $this->request->input('FelonyExplain'),
            'CodeLouEdLevel' => $this->request->input('CodeLouEdLevel'),
            'DegreeWhatType' => $this->request->input('DegreeWhatType')
        ];

        SoapWrapper::add(function ($service) { $service->name('SelfRegister')->wsdl(env('ENROLL_URL')); });

        SoapWrapper::service('SelfRegister', function ($service) use ($data) {

            var_dump($service->call('SelfRegister', [$data]));
        });
    }

    public function register()
    {
        $data = array(
            'name' => $this->request->input('first').' '.$this->request->input('last'),
            'email' => $this->request->input('email')
        );

        Mail::send('emails.register', $data, function ($message) {
            $message->subject('codelouisville.org: New Candidate Registration');
            $message->from($this->mail_from, 'Code Louisville');
            $message->to($this->mail_recipient);
        });

        return redirect('learn#register')->withSuccess('success');
    }

    public function mentor()
    {
        $data = array(
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'track' => $this->request->input('track'),
            'availability' => $this->request->input('availability'),
            'experience' => $this->request->input('experience'),
            'employer' => $this->request->input('employer'),
            'questions' => $this->request->input('questions')
        );

        Mail::send('emails.mentor', $data, function ($message) {
            $message->subject('codelouisville.org: New Mentor Contact');
            $message->from($this->mail_from, 'Code Louisville');
            $message->to($this->mail_recipient);
        });

        return redirect('mentor#form')->withSuccess('success');
    }

    public function mentor_add()
    {
        $success = 'Added';
        $data = $this->request->all();
        $user = $data['github'];

        $client = new GuzzleHttp\Client();
        if( $data['github'] ) { $data['github_id'] = json_decode($client->request('GET', "https://api.github.com/users/$user")->getBody())->id; }

        Mentors::updateOrCreate(['id' => ''], $data);
        return Redirect::back()->withSuccess($success);
    }

    public function mentor_edit($id)
    {
        $success = 'Updated';
        $data = $this->request->all();
        $user = $data['github'];

        $client = new GuzzleHttp\Client();
        $data['github_id'] = json_decode($client->request('GET', "https://api.github.com/users/$user")->getBody())->id;

        Mentors::updateOrCreate(['id' => $id], $data);
        return Redirect::back()->withSuccess($success);
    }

    public function hire()
    {
        $data = array(
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'involvement' => $this->request->input('involvement'),
            'organization' => $this->request->input('organization'),
            'comment' => $this->request->input('message')
        );

        Mail::send('emails.hire', $data, function ($message) {
            $message->subject('codelouisville.org: New Employer Contact');
            $message->from($this->mail_from, 'Code Louisville');
            $message->to($this->mail_recipient);
        });

        return redirect('hire#form')->withSuccess('success');
    }

    public function graduate_add()
    {
        $success = 'Added';
        $data = $this->request->all();

        Grads::updateOrCreate(['id' => ''], $data);
        return Redirect::back()->withSuccess($success);
    }

    public function graduate_edit($id)
    {
        $success = 'Updated';
        $data = $this->request->all();

        Grads::updateOrCreate(['id' => $id], $data);
        return Redirect::back()->withSuccess($success);
    }
}
