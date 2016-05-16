@extends('layout')
@section('title', 'Enrollment Form')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="enroll" class="content p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <h3 class="form-title" id="enrollment">Enrollment Form</h3>
                    <section class="enrollment-form inset">
                        <validator name="enroll">
                            <form action="/candidates/enroll" method="POST">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>First name</p>
                                            <input type="text" name="FirstName" v-validate:FirstName="['required']">
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Last name</p>
                                            <input type="text" name="LastName" v-validate:LastName="['required']">
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Social Security Number</p>
                                            <input type="text" name="ssn" v-validate:ssn="['required']" placeholder="xxx-xx-xxxx">
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Address</p>
                                            <input type="text" name="Address" v-validate:Address="['required']">
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>City</p>
                                            <input type="text" name="City" v-validate:City="['required']">
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            <p>State</p>
                                            <input type="text" name="State" v-validate:State="['required']">
                                        </label>
                                    </div>
                                    <div class="col-sm-4">
                                        <label>
                                            <p>County</p>
                                            <input type="text" name="CountyCode" v-validate:CountyCode="['required']">
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Zip code</p>
                                            <input type="text" name="ZipCode" v-validate:ZipCode="['required','zip','zipFormat']">
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Birth date</p>
                                            <input type="text" name="BirthDate" v-validate:BirthDate="['required','dob']" placeholder="mm/dd/yyyy">
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Phone</p>
                                            <input type="text" name="MsgPhone" v-validate:MsgPhone="['required','phone']" placeholder="xxx-xxx-xxxx">
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Email address</p>
                                            <input type="text" name="Email" v-validate:Email="['required','email']">
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>What is your gender?</p>
                                            <select name="Gender" v-validate:Gender="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="2">Male</option>
                                                <option value="1">Female</option>
                                                <option value="3">Transgender female to male</option>
                                                <option value="5">Transgender male to female</option>
                                                <option value="6">Other</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p>What is your race(s)?</p>
                                        <p><input type="checkbox" name="AmerIndian"> &nbsp; American Indian / Alaskan Native</p>
                                        <p><input type="checkbox" name="Asian"> &nbsp; Asian</p>
                                        <p><input type="checkbox" name="Black"> &nbsp; Black</p>
                                        <p><input type="checkbox" name="White"> &nbsp; White</p>
                                        <p><input type="checkbox" name="Islander"> &nbsp; Native Hawaiian or Other Pacific Islander</p>
                                        <p><input type="checkbox" name="DidNotIdentifyRace"> &nbsp; I do not choose to identify</p>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Are you Hispanic?</p>
                                            <select name="Hispanic" v-validate:Hispanic="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                                <option value="0">Unknown</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Is your primary language English?</p>
                                            <select name="PrimaryLangEng" v-model="langEng" v-validate:PrimaryLangEng="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div v-if="langEng == 2">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Is your primary language Spanish?</p>
                                                <select name="PrimaryLangSpan" v-validate:PrimaryLangSpan="">
                                                    <option value="" selected>- Select -</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2">No</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>
                                            <p>Are you a citizen of the United States?</p>
                                            <select name="Citizenship" v-validate:Citizenship="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="1">U.S. Citizen</option>
                                                <option value="2">Non-Citizen Eligible for Work</option>
                                                <option value="3">Non-Citizen Ineligible for Work</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>
                                            <p>Are you a veteran?</p>
                                            <select name="VeteranStatus" v-validate:VeteranStatus="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="1">Yes - Served more than 180 days</option>
                                                <option value="4">Yes - Served 180 days or less</option>
                                                <option value="2">No</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label>
                                            <p>What is your employment status?</p>
                                            <select name="EmploymentStatus" v-model="employment" v-validate:EmploymentStatus="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="1">Employed Full Time</option>
                                                <option value="2">Employed Part Time</option>
                                                <option value="3">Unemployed, Actively Looking for Work</option>
                                                <option value="4">Unemployed, Not Seeking Employment</option>
                                                <option value="5">Self Employed</option>
                                                <option value="6">Freelance / Contractor</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div v-if="employment == 1 || employment == 2 || employment == 5 || employment == 6">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>What is your current wage?</p>
                                                <input type="text" name="JobRateOfPay" v-validate:JobRateOfPay="['required']">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <p>Wage hourly or annually?</p>
                                                <select name="WagePeriod" v-validate:WagePeriod="['required']">
                                                    <option value="" selected>- Select -</option>
                                                    <option value="H">Hourly</option>
                                                    <option value="A">Annually</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <label>
                                            <p>Are you currently receiving or have you exhausted unemployment benefits?</p>
                                            <select name="UIStatus" v-validate:UIStatus="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="4">Not receiving unemployment insurance</option>
                                                <option value="1">Receiving unemployment insurance</option>
                                                <option value="3">Exhausted unemployment insurance</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>
                                            <p>Are you disabled?</p>
                                            <select name="DisablingCondition" v-validate:DisablingCondition="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>
                                            <p>Have you ever been convicted of a felony? (Marking yes will not disqualify you from the program)</p>
                                            <select name="HaveFelony" v-model="felony" v-validate:HaveFelony="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="1">Yes</option>
                                                <option value="2">No</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div v-if="felony == 1">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <p>If yes, please explain, so we can better assist you:</p>
                                                <textarea name="FelonyExplain"></textarea>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label>
                                            <p>Highest Level of Education Completed?</p>
                                            <select name="CodeLouEdLevel" v-model="eduLevel" v-validate:CodeLouEdLevel="['required']">
                                                <option value="" selected>- Select -</option>
                                                <option value="1">High School Diploma</option>
                                                <option value="2">GED</option>
                                                <option value="3">Vocational Training</option>
                                                <option value="4">Some College / No degree</option>
                                                <option value="5">Associate Degree</option>
                                                <option value="6">Bachelor Degree</option>
                                                <option value="7">Masters Degree</option>
                                                <option value="8">Ph. D.</option>
                                                <option value="9">None of the above</option>
                                            </select>
                                        </label>
                                    </div>
                                </div>
                                <hr>
                                <div v-if="eduLevel == 5 || eduLevel == 6 || eduLevel == 7 || eduLevel == 8">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <label>
                                                <p>If you hold a degree, what was your major?</p>
                                                <input type="text" name="DegreeWhatType">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="inset notes m1-bottom" @include('edit', ['key' => 'enroll_form_desc'])>
                                    {!! $enroll_form_desc !!}
                                </div>
                                <p><input type="radio" name="tc" value="y" v-validate:eligible="['required','true']"> I agree &nbsp;&nbsp; <input type="radio" name="tc" value="n" v-validate:eligible> I do not agree</p>
                                <div v-if="$enroll.valid">
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <button type="submit" class="button button-block pink">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </validator>
                    </section>
                </div>
                <div class="col-sm-3">
                    <nav class="subnav" data-spy="affix" data-offset-top="83" data-offset-bottom="752">
                        <h1 class="m0">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="/candidates"><span class="fa fa-arrow-left"></span> Back to Candidates page</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.20/vue.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue-validator/2.0.0/vue-validator.min.js"></script>
    <script>
        Vue.validator('email', function (v) {
            return /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(v)
        })

        Vue.validator('zipFormat', function (v) {
            return /^\d{5}$/.test(v)
        })

        Vue.validator('zip', function (v) {
            var valid = [40221,40222,40223,40218,40219,40220,40201,40118,40202,40204,40203,40059,40023,40018,40025,40041,40027,40205,40213,40212,40214,40216,40215,40211,40207,40206,40208,40210,40209,40224,40282,40281,40283,40287,40285,40269,40268,40270,40280,40272,40289,40296,40295,40297,40299,40298,40291,40290,40292,40294,40293,40241,40233,40242,40245,40243,40228,40225,40229,40232,40231,40250,40258,40257,40259,40266,40261,40252,40251,40253,40256,40255,40165,40166,40150,40129,40047,40109,40110,40070,40068,40075,40007,40011,40058,40019,40036,40050,40057,40055,40032,40010,40056,40031,40077,40026,40014,40076,40003,40065,40022,40067,40066,40071,40046,40045,40006,47141,47133,47134,47143,47147,47162,47144,47111,47126,47104,47106,47131,47132,47129,47130,47163,47172,47199,47190,47174,47118,47123,47137,47116,47140,47145,47175,47122,47119,47151,47146,47150,47124,47125,47165,47167,47108,47120,47136,47166,47107,47114,47110,47135,47117,47112,47160,47142,47161,47115,47164,47170,47138,47177,47102]
            if(valid.indexOf(parseInt(v)) === -1)
            {
                return false
            }
            else
            {
                return true
            }
        })

        Vue.validator('true', function (v) {
            return /^y$/.test(v)
        })

        new Vue({
            el: '#enroll',
            methods: {
                onReset: function () {
                    this.$resetValidation()
                }
            }
        })
    </script>

@endsection
