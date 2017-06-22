@extends('layout')
@section('title', 'Enrollment Form')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="enroll" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <h3 class="form-title" id="enrollment">Enrollment Form</h3>
                    @if ($secure == 'true')
                        <section class="enrollment-form inset">
                            <validator name="enroll">
                                <form action="/learn/enroll" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>First name</p>
                                                <input type="text" name="FirstName" v-validate:FirstName="['required']" value="Steven">
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Last name</p>
                                                <input type="text" name="LastName" v-validate:LastName="['required']" value="Peercy">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Social Security Number</p>
                                                <input type="text" name="SSN" v-validate:ssn="['required']" placeholder="xxx-xx-xxxx" value="404390159">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Address</p>
                                                <input type="text" name="Address" v-validate:Address="['required']" value="708 E. Oak Street">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>City</p>
                                                <input type="text" name="City" v-validate:City="['required']" value="Louisville">
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>
                                                <p>State</p>
                                                <input type="text" name="State" v-validate:State="['required']" value="KY">
                                            </label>
                                        </div>
                                        <div class="col-sm-4">
                                            <label>
                                                <p>County</p>
                                                <input type="text" name="CountyCode" v-validate:CountyCode="['required']" value="Jefferson">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Zip code</p>
                                                <input type="text" name="ZipCode" v-validate:ZipCode="['required','zip','zipFormat']" value="40203">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Birth date</p>
                                                <input type="text" name="BirthDate" v-validate:BirthDate="['required','dob']" placeholder="mm/dd/yyyy" value="09/06/1984">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Phone</p>
                                                <input type="text" name="MsgPhone" v-validate:MsgPhone="['required','phone']" placeholder="xxx-xxx-xxxx" value="502-310-7865">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>Email address</p>
                                                <input type="text" name="Email" v-validate:Email="['required','email']" value="speercy@gmail.com">
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>
                                                <p>What is your gender?</p>
                                                <select name="Gender" v-validate:Gender="['required']">
                                                    <option value="">- Select -</option>
                                                    <option value="2" selected>Male</option>
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
                                            <p><input type="checkbox" name="White" checked> &nbsp; White</p>
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
                                                    <option value="">- Select -</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2" selected="">No</option>
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
                                                    <option value="">- Select -</option>
                                                    <option value="1" selected>Yes</option>
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
                                                    <option value="">- Select -</option>
                                                    <option value="1" selected>U.S. Citizen</option>
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
                                                    <option value="">- Select -</option>
                                                    <option value="1">Yes - Served more than 180 days</option>
                                                    <option value="4">Yes - Served 180 days or less</option>
                                                    <option value="2" selected="">No</option>
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
                                                    <option value="">- Select -</option>
                                                    <option value="1" selected="">Employed Full Time</option>
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
                                                    <input type="text" name="JobRateOfPay" v-validate:JobRateOfPay="['required']" value="1">
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>
                                                    <p>Wage hourly or annually?</p>
                                                    <select name="WagePeriod" v-validate:WagePeriod="['required']">
                                                        <option value="">- Select -</option>
                                                        <option value="H">Hourly</option>
                                                        <option value="A" selected="">Annually</option>
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
                                                    <option value="">- Select -</option>
                                                    <option value="4" selected="">Not receiving unemployment insurance</option>
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
                                                    <option value="">- Select -</option>
                                                    <option value="1">Yes</option>
                                                    <option value="2" selected="">No</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>
                                                <p>Have you ever been convicted of a felony? (Marking yes will not disqualify you from the program)</p>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <select name="HaveFelony" v-model="felony" v-validate:HaveFelony="['required']">
                                                            <option value="">- Select -</option>
                                                            <option value="1">Yes</option>
                                                            <option value="2" selected="">No</option>
                                                        </select>
                                                    </div>
                                                </div>
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
                                        <div class="col-sm-6">
                                            <label>
                                                <p>Highest Level of Education Completed?</p>
                                                <select name="CodeLouEdLevel" v-model="eduLevel" v-validate:CodeLouEdLevel="['required']">
                                                    <option value="">- Select -</option>
                                                    <option value="1">High School Diploma</option>
                                                    <option value="2">GED</option>
                                                    <option value="3">Vocational Training</option>
                                                    <option value="4">Some College / No degree</option>
                                                    <option value="5">Associate Degree</option>
                                                    <option value="6" selected="">Bachelor Degree</option>
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
                                                    <input type="text" name="DegreeWhatType" value="B.S. Communications">
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>

                                    {{-- - - - - - - NEW FIELDS - - - - - - --}}

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>
                                                <p>Are you currently enrolled in a college or university and pursuing a degree?</p>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <select name="CodeLouEnrolledUniv" v-model="codeLouEnrolledUniv" v-validate:codeLouEnrolledUniv="['required']">
                                                            <option value="">- Select -</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No" selected="">No</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div v-if="codeLouEnrolledUniv == 'Yes'">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>
                                                    <p>What college or university, and what degree are you pursuing?</p>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <input type="text" name="CodeLouWhatUnivDegree">
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>
                                                <p>Are you currently employed in the technology industry or performing a technology-related job?</p>
                                                <div class="row">
                                                    <div class="col-sm-4">
                                                        <select name="EmployedTech" v-model="employedTech" v-validate:employedTech="['required']">
                                                            <option value="">- Select -</option>
                                                            <option value="Yes" selected="">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="Unsure">Unsure</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div v-if="employedTech == 'Yes'">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>
                                                    <p>If yes, what is your current job title?</p>
                                                    <input type="text" name="JobMainDuties" value="Director of Software Development">
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>
                                                <p>Are you interested in gaining employment as a software developer or in a software development-related position?</p>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <select name="InterestedTech" v-model="interestedTech" v-validate:interestedTech="['required']">
                                                            <option value="">- Select -</option>
                                                            <option value="Yes">Yes</option>
                                                            <option value="No">No</option>
                                                            <option value="I am already employed in this area" selected="">I am already employed in this area</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                    <hr>
                                    <div v-if="interestedTech == 'Yes'">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>
                                                    <p>What are your plans for the training you'll receive through Code Louisville?  For example, what type of job are you interested in obtaining?</p>
                                                    <div class="row">
                                                        <div class="col-sm-6">
                                                            <textarea name="JobInterest"></textarea>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p>What classroom locations are you available to attend?</p>
                                            <p><input type="checkbox" name="CodeLou_Lou" checked> &nbsp; Downtown Louisville</p>
                                            <p><input type="checkbox" name="CodeLou_Jeff"> &nbsp; Jeffersonville, IN</p>
                                            <p><input type="checkbox" name="CodeLou_LaGrange"> &nbsp; La Grange, KY</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <p>Will you adhere to our <a href="https://drive.google.com/file/d/0B28qs3pVLuXSTGhWbU1JWng0YWM/view" target="_blank">Code of Conduct</a>?</p>
                                    <p><input type="radio" name="CodeLouCodeOfConduct" value="y" group="eligibility" v-validate:conduct="['required','true']" checked> Yes &nbsp;&nbsp; <input type="radio" name="CodeLouCodeOfConduct" value="n" v-validate:conduct> No</p>
                                    <hr>

                                    {{-- - - - - - - END NEW FIELDS - - - - - - --}}

                                    <div class="inset notes m1-bottom" @include('edit', ['key' => 'enroll_form_desc'])>
                                        {!! $enroll_form_desc !!}
                                    </div>
                                    <p><input type="radio" name="tc" value="y" v-validate:eligible="['required','true']" checked> I agree &nbsp;&nbsp; <input type="radio" name="tc" value="n" v-validate:eligible> I do not agree</p>
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
                    @else
                        <section class="enrollment-form inset">
                            <p class="m0">Enrollment is down. Please check back soon, we&rsquo;re working hard to fix this issue.</p>
                        </section>
                    @endif
                </div>
                <div class="col-sm-3">
                    <nav class="subnav" data-spy="affix" data-offset-top="83" data-offset-bottom="752">
                        <h1 class="m0">{{ $title }}</h1>
                        <ul class="nav">
                            <li><a href="/learn"><span class="fa fa-arrow-left"></span> Back to Learn</a></li>
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
