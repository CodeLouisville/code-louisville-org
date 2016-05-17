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

@section('vue')

    @include('components.vue')

    <script>
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
