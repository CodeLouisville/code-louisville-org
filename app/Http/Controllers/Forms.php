<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use GuzzleHttp;
use Illuminate\Http\Request;
use Mail;
use Redirect;
use Sentry;

use App\Enrollments;
use App\Grads;
use App\Mentors;

use App\Traits\GetContent;

class Forms extends Controller
{
    use GetContent;

    protected $request;

    private $mail_from;
    private $mail_recipient;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->mail_from = env('MAIL_FROM');
        $this->mail_recipient = env('MAIL_RECIPIENT');
    }

    public function apply()
    {
        $data = $this->fetch_content();

        $locality = $this->get_locality($this->request->input('ZipCode'));

        $params = [
            'PassPhrase' => env('APPLY_PASS'),
            'FirstName' => $this->request->input('FirstName'),
            'LastName' => $this->request->input('LastName'),
            'SSN' => $this->request->input('SSN'),
            'Address' => $this->request->input('Address'),
            'City' => $this->request->input('City'),
            'State' => $locality['state'],
            'CountyCode' => $locality['county'],
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
            'DegreeWhatType' => $this->request->input('DegreeWhatType'),
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
            'RecOther' => $this->request->input('RecOther'),
            'CodeLouCodeOfConduct' => $this->request->input('CodeLouCodeOfConduct')
        ];

        $result = $this->send_to_clienttrack($params);

        if (strpos($result, 'Success') !== false) {
            Mail::send('emails.register', $params, function ($message) {
                $message->subject('codelouisville.org: New Candidate Application');
                $message->from($this->mail_from, 'Code Louisville');
                $message->to($this->mail_recipient);
            });

            Mail::send('emails.register-thanks', $params, function ($message) {
                $message->subject('Thank you for your application');
                $message->from($this->mail_from, 'Code Louisville');
                $message->to($this->request->input('Email'));
            });

            return view('pages.apply-thanks', $data);
        } else {
            Sentry::captureException(new \Exception, [
                'extra' => [
                    'type' => 'ClientTrack Error',
                    'response' => $result
                ]
            ]);

            $data['title'] = 'Apply';
            $data['error'] = true;
            $data['secure'] = $this->request->secure() ? 'true' : 'false';

            return view('pages.apply', $data);
        }
    }

    public function register()
    {
        $data = [
            'name' => $this->request->input('first').' '.$this->request->input('last'),
            'first' => $this->request->input('first'),
            'email' => $this->request->input('email')
        ];

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
        $data = [
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'track' => $this->request->input('track'),
            'availability' => $this->request->input('availability'),
            'experience' => $this->request->input('experience'),
            'employer' => $this->request->input('employer'),
            'questions' => $this->request->input('questions')
        ];

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
        if ($data['github']) {
            $data['github_id'] = json_decode($client->request('GET', "https://api.github.com/users/$user")->getBody())->id;
        }

        Mentors::updateOrCreate(['id' => ''], $data);
        return Redirect::back()->withSuccess($success);
    }

    public function mentor_edit($id)
    {
        $success = 'Updated';
        $data = $this->request->all();
        $user = $data['github'];

        $client = new GuzzleHttp\Client();
        if ($data['github']) {
            $data['github_id'] = json_decode($client->request('GET', "https://api.github.com/users/$user")->getBody())->id;
        }

        Mentors::updateOrCreate(['id' => $id], $data);
        return Redirect::back()->withSuccess($success);
    }

    public function hire()
    {
        $data = [
            'name' => $this->request->input('name'),
            'email' => $this->request->input('email'),
            'involvement' => $this->request->input('involvement'),
            'organization' => $this->request->input('organization'),
            'comment' => $this->request->input('message')
        ];

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

    private function get_locality($input)
    {
        $locales = [
            "KY" => [
                "21111" => /* Jefferson */  [40221,40222,40223,40218,40217,40219,40220,40201,40118,40202,40204,40203,40059,40023,40018,40025,40041,40027,40205,40213,40212,40214,40216,40215,40211,40207,40206,40208,40210,40209,40224,40282,40281,40283,40287,40285,40269,40268,40270,40280,40272,40289,40296,40295,40297,40299,40298,40291,40290,40292,40294,40293,40241,40233,40242,40245,40243,40228,40225,40229,40232,40231,40250,40258,40257,40259,40266,40261,40252,40251,40253,40256,40255],
                "21029" => /* Bullitt */    [40165,40166,40150,40129,40047,40109,40110],
                "21103" => /* Henry */      [40070,40068,40075,40007,40011,40058,40019,40036,40050,40057,40055],
                "21185" => /* Oldham */     [40032,40010,40056,40031,40077,40026,40014],
                "21211" => /* Shelby */     [40076,40003,40065,40022,40067,40066],
                "21215" => /* Spencer */    [40071,40046],
                "21223" => /* Trimble */    [40045,40006]
            ],
            "IN" => [
                "18019" => /* Clark */      [47141,47133,47134,47143,47147,47162,47144,47111,47126,47104,47106,47131,47132,47129,47130,47163,47172,47199,47190],
                "18025" => /* Crawford */   [47174,47118,47123,47137,47116,47140,47145,47175],
                "18043" => /* Floyd */      [47122,47119,47151,47146,47150,47124],
                "18175" => /* Washington */ [47125,47165,47167,47108,47120],
                "18061" => /* Harrison */   [47136,47166,47107,47114,47110,47135,47117,47112,47160,47142,47161,47115,47164],
                "18143" => /* Scott */      [47170,47138,47177,47102]
            ]
        ];

        foreach ($locales as $state => $counties) {
            foreach ($counties as $county => $zips) {
                foreach ($zips as $zip) {
                    if ($zip == $input) {
                        return [
                            'county' => $county,
                            'state' => $state
                        ];
                    }
                }
            }
        }

        return [
            'county' => '*****',
            'state' => 'KY'
        ];
    }

    private function send_to_clienttrack($params)
    {
        $client = new \SoapClient(env('APPLY_URL'));

        $response = $client->__soapCall("SelfRegister", [$params]);

        return $response->SelfRegisterResult;
    }
}
