<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use GuzzleHttp;
use Illuminate\Http\Request;
use Mail;
use Redirect;
use Artisaninweb\SoapWrapper\SoapWrapper;

use App\Enrollments;
use App\Grads;
use App\Mentors;

use App\Traits\GetContent;

class Forms extends Controller
{
    use GetContent;

    protected $request;
    protected $soapWrapper;

    private $mail_from;
    private $mail_recipient;

    public function __construct(Request $request, SoapWrapper $soapWrapper)
    {
        $this->request = $request;
        $this->mail_from = env('MAIL_FROM');
        $this->mail_recipient = env('MAIL_RECIPIENT');
        $this->soapWrapper = $soapWrapper;
    }

    public function apply()
    {
        $data = [
            'PassPhrase' => env('ENROLL_PASS'),
            'FirstName' => $this->request->input('FirstName'),
            'LastName' => $this->request->input('LastName'),
            'SSN' => $this->request->input('SSN'),
            'Address' => $this->request->input('Address'),
            'City' => $this->request->input('City'),
            'State' => $this->request->input('State'),
            'CountyCode' => $this->request->input('CountyCode'),
            'ZipCode' => $this->request->input('ZipCode'),
            'BirthDate' => $this->request->input('BirthDate'),
            'MsgPhone' => $this->request->input('MsgPhone'),
            'Email' => $this->request->input('Email'),
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
            'UIStatus' => $this->request->input('UIStatus'),
            'DisablingCondition' => $this->request->input('DisablingCondition'),
            'HaveFelony' => $this->request->input('HaveFelony'),
            'CodeLouEdLevel' => $this->request->input('CodeLouEdLevel'),
            'EmployedTech' => $this->request->input('EmployedTech'),
            'JobMainDuties' => $this->request->input('JobMainDuties'),
            'InterestedTech' => $this->request->input('InterestedTech'),
            'JobInterest' => $this->request->input('JobInterest'),
            'CodeLou_Lou' => $this->request->input('CodeLou_Lou'),
            'CodeLou_Jeff' => $this->request->input('CodeLou_Jeff'),
            'CodeLou_LaGrange' => $this->request->input('CodeLou_LaGrange'),
            'SelectiveService' => $this->request->input('SelectiveService'),
            'IncomeLevel' => $this->request->input('IncomeLevel'),
            'CodeLouEnrolledUniv' => $this->request->input('CodeLouEnrolledUniv'),
            'CodeLouWhatUnivDegree' => $this->request->input('CodeLouWhatUnivDegree'),
            'CodeLouCat1DslWrk' => $this->request->input('CodeLouCat1DslWrk'),
            'CodeLouCat2DslWrk' => $this->request->input('CodeLouCat2DslWrk'),
            'CodeLouCat3DslWrk' => $this->request->input('CodeLouCat3DslWrk'),
            'CodeLouCat4DslWrk' => $this->request->input('CodeLouCat4DslWrk'),
            'CodeLouCat5DslWrk' => $this->request->input('CodeLouCat5DslWrk'),
            'CodeLouNumHouse' => $this->request->input('CodeLouNumHouse'),
            'RecTANF' => $this->request->input('RecTANF'),
            'RecGeneralAsst' => $this->request->input('RecGeneralAsst'),
            'RecOther' => $this->request->input('RecOther')
        ];

        if (env('ENROLL_LOCAL') == 'true')
        {
            $data_lc = array_change_key_case($data, CASE_LOWER);
            $enrollment = Enrollments::create($data_lc);

            $data = $this->fetch_content();
            $data['enrollment'] = $enrollment;

            return view('pages.apply-thanks', $data);
        }
        else
        {
            $this->soapWrapper->add('CodeLouis', function ($service) {
                $service
                    ->wsdl(env('ENROLL_URL'))
                    ->trace(true);
            });

            $response = $this->soapWrapper->call('CodeLouis.SelfRegister', $data);

            var_dump($response);
        }

        Mail::send('emails.register', $data, function ($message) {
            $message->subject('codelouisville.org: New Candidate Application');
            $message->from($this->mail_from, 'Code Louisville');
            $message->to($this->mail_recipient);
        });

        Mail::send('emails.register-thanks', $data, function ($message) {
            $message->subject('Thank you for your application');
            $message->from($this->mail_from, 'Code Louisville');
            $message->to($this->request->input('Email'));
        });
    }

    public function register()
    {
        $data = array(
            'name' => $this->request->input('first').' '.$this->request->input('last'),
            'first' => $this->request->input('first'),
            'email' => $this->request->input('email')
        );

        Mail::send('emails.register', $data, function ($message) {
            $message->subject('codelouisville.org: New Candidate Registration');
            $message->from($this->mail_from, 'Code Louisville');
            $message->to($this->mail_recipient);
        });

        Mail::send('emails.register-thanks', $data, function ($message) {
            $message->subject('Thank you for your registration');
            $message->from($this->mail_from, 'Code Louisville');
            $message->to($this->request->input('email'));
        });

        return redirect('learn#apply')->withSuccess('success');
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
        if( $data['github'] ) { $data['github_id'] = json_decode($client->request('GET', "https://api.github.com/users/$user")->getBody())->id; }

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
