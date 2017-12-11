@extends('layout')
@section('title', 'Application Form')

@section('content')

    @include('components.nav', [ 'home' => false ])

    <section id="enroll" class="content background-white p2-top p4-bottom">
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <section id="structure" class="m2-bottom">
                        <h3 class="m0" @include('edit', ['key' => 'apply_intro_title'])>{!! $apply_intro_title !!}</h3>
                        <hr>
                        <div @include('edit', ['key' => 'apply_intro_desc'])>{!! $apply_intro_desc !!}</div>
                    </section>
                    @if ($error)
                        <div class="alert alert-danger">There was an error with submitting your form. Please try again later.</div>
                    @endif
                    <h3 class="form-title" id="enrollment">Application Form</h3>
                    @if ($secure == 'true')
                        <section class="enrollment-form inset">
                            @if (env('APPLY_LIVE') == 'true')
                                <validator name="enroll">
                                    <form action="/learn/apply" method="POST">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>First name</p>
                                                    <input type="text" name="FirstName" v-validate:FirstName="['required']">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>Last name</p>
                                                    <input type="text" name="LastName" v-validate:LastName="['required']">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>Social Security Number</p>
                                                    <input type="text" name="SSN" v-validate:ssn="['required','ssn']" placeholder="xxx-xx-xxxx">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-sm-8">
                                                <p><small><em>We need your SSN in order to verify your eligibility for the Code Louisville program and the services provided through KentuckianaWorks.</em></small></p>
                                                <p><small><em>Your information will be securely stored and will never be shared with any 3rd parties.</em></small></p>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>Address</p>
                                                    <input type="text" name="Address" v-validate:Address="['required']">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>City</p>
                                                    <input type="text" name="City" v-validate:City="['required']">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>Zip code</p>
                                                    <input type="text" name="ZipCode" maxlength="5" v-validate:ZipCode="['required','zip','zipFormat']">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>Birth date</p>
                                                    <input type="text" name="BirthDate" v-validate:BirthDate="['required','dob']" placeholder="mm/dd/yyyy">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>Phone</p>
                                                    <input type="text" name="MsgPhone" v-validate:MsgPhone="['required','phone']" placeholder="xxx-xxx-xxxx">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>Email address</p>
                                                    <input type="text" name="Email" v-model="email" detect-change="on" v-validate:Email="{
                                                        required: { rule: true },
                                                        exists: { rule: true, initial: 'on' }
                                                        }">
                                                    <span></span>
                                                </label>
                                            </div>
                                            <div class="col-sm-4 error">
                                                @{{emailAlreadyExists ? "That email is already in use. Please contact apply@codelouisville.org if you need to change your information or have any questions." : ""}}
                                        </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <label>
                                                    <p>What is your gender?</p>
                                                    <select name="Gender" v-model="gender" v-validate:Gender="['required']">
                                                        <option value="" selected>- Select -</option>
                                                        <option value="2">Male</option>
                                                        <option value="1">Female</option>
                                                    </select>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="gender == '2'">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <p>Are you registered for the selective service (the draft)?</p>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <select name="SelectiveService" v-model="selectiveService" v-validate:selectiveService="['required']">
                                                                    <option value="" selected>- Select -</option>
                                                                    <option value="1">Yes, registered</option>
                                                                    <option value="2">No, not registered</option>
                                                                    <option value="4">Not required</option>
                                                                </select>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>What is your race(s)?</p>
                                                <p><input type="checkbox" value="1" v-model="amerIndian" name="AmerIndian"> &nbsp; American Indian / Alaskan Native</p>
                                                <p><input type="checkbox" value="1" v-model="asian" name="Asian"> &nbsp; Asian</p>
                                                <p><input type="checkbox" value="1" v-model="black" name="Black"> &nbsp; Black</p>
                                                <p><input type="checkbox" value="1" v-model="white" name="White"> &nbsp; White</p>
                                                <p><input type="checkbox" value="1" v-model="islander" name="Islander"> &nbsp; Native Hawaiian or Other Pacific Islander</p>
                                                <p><input type="checkbox" value="1" v-model="didNotIdentifyRace" name="DidNotIdentifyRace"> &nbsp; I do not choose to identify</p>
                                                <input type="hidden" v-model="race" v-validate:race="['required']">
                                                <span></span>
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
                                                        <option value="3">Unknown</option>
                                                    </select>
                                                    <span></span>
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
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="langEng == 2">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <label>
                                                        <p>Is your primary language Spanish?</p>
                                                        <select name="PrimaryLangSpan" v-validate:PrimaryLangSpan="['required']">
                                                            <option value="" selected>- Select -</option>
                                                            <option value="1">Yes</option>
                                                            <option value="2">No</option>
                                                        </select>
                                                        <span></span>
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
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>
                                                    <p>Are you a veteran?</p>
                                                    <select name="VeteranStatus" v-model="veteranStatus" v-validate:veteranStatus="['required']">
                                                        <option value="" selected>- Select -</option>
                                                        <option value="1">Yes - Served more than 180 days</option>
                                                        <option value="4">Yes - Served 180 days or less</option>
                                                        <option value="3">Spouse of a veteran</option>
                                                        <option value="2">No</option>
                                                    </select>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="veteranStatus == '3'">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <p>Do you meet one or more of the following?</p>
                                                        <ul>
                                                            <li>A spouse of any veteran who died of a service-connected disability</li>
                                                            <li>A spouse of someone on active duty who is listed as missing in action, captured, or detained by a foreign power</li>
                                                            <li>Spouse of a veteran who has a total disability resulting from service-connected disability</li>
                                                            <li>A spouse of any veteran who died while a disability was in existence</li>
                                                        </ul>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <select name="CodeLouCat5DslWrk" v-model="codeLouCat5DslWrk" v-validate:codeLouCat5DslWrk="['required']">
                                                                    <option value="" selected>- Select -</option>
                                                                    <option value="1">Yes</option>
                                                                    <option value="2">No</option>
                                                                </select>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>
                                                    <p>What is your employment status?</p>
                                                    <select name="EmploymentStatus" v-model="employmentStatus" v-validate:employmentStatus="['required']">
                                                        <option value="" selected>- Select -</option>
                                                        <option value="1">Employed Full Time</option>
                                                        <option value="2">Employed Part Time</option>
                                                        <option value="3">Unemployed, Actively Looking for Work</option>
                                                        <option value="4">Unemployed, Not Seeking Employment</option>
                                                        <option value="5">Self Employed</option>
                                                        <option value="6">Freelance / Contractor</option>
                                                    </select>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
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
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>
                                                    <p>Are you disabled?</p>
                                                    <select name="DisablingCondition" v-validate:DisablingCondition="['required']">
                                                        <option value="" selected>- Select -</option>
                                                        <option value="1">Yes, sometimes keeps me from working</option>
                                                        <option value="2">Yes, doesn't keep me from working</option>
                                                        <option value="3">No</option>
                                                    </select>
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p>Please check any of the following benefits that apply to you:</p>
                                                <p><input type="checkbox" v-model="tRecTANF"> &nbsp; Public Assistance (cash) income support through programs such as TANF/KTAP, SSI</p>
                                                <p><input type="checkbox" v-model="tRecGeneralAsst"> &nbsp; SNAP</p>
                                                <p><input type="checkbox" v-model="tRecOther"> &nbsp; Homeless temporary residence/shelter</p>
                                                <input type="hidden" v-model="recTANF" name="RecTANF">
                                                <input type="hidden" v-model="recGeneralAsst" name="RecGeneralAsst">
                                                <input type="hidden" v-model="recOther" name="RecOther">
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
                                                                <option value="" selected>- Select -</option>
                                                                <option value="1">Yes</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="felony == '1'">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <p>If yes, please explain, so we can better assist you:</p>
                                                        <textarea name="FelonyExplain" v-validate:felonyExplain="['required']"></textarea>
                                                        <span></span>
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
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="eduLevel == 5 || eduLevel == 6 || eduLevel == 7 || eduLevel == 8">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>
                                                        <p>If you hold a degree, what was your major?</p>
                                                        <input type="text" name="DegreeWhatType" v-validate:DegreeWhatType="['required']">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>
                                                    <p>Are you currently enrolled in a college or university and pursuing a degree?</p>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <select name="CodeLouEnrolledUniv" v-model="codeLouEnrolledUniv" v-validate:codeLouEnrolledUniv="['required']">
                                                                <option value="" selected>- Select -</option>
                                                                <option value="1">Yes</option>
                                                                <option value="2">No</option>
                                                            </select>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="codeLouEnrolledUniv == '1'">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <p>What college or university, and what degree are you pursuing?</p>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <input type="text" name="CodeLouWhatUnivDegree" v-validate:codeLouWhatUnivDegree="['required']">
                                                                <span></span>
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
                                                                <option value="" selected>- Select -</option>
                                                                <option value="1">Yes</option>
                                                                <option value="2">No</option>
                                                                <option value="3">Unsure</option>
                                                            </select>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="employedTech == '1'">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label>
                                                        <p>If yes, what is your current job title?</p>
                                                        <input type="text" name="JobMainDuties" v-validate:jobMainDuties="['required']">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label>
                                                    <p>Have you been laid off or have you received notice of layoff from your current or most recent employer?</p>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <select name="CodeLouCat1DslWrk" v-model="codeLouCat1DslWrk" v-validate:codeLouCat1DslWrk="['required']">
                                                                <option value="">- Select -</option>
                                                                <option value="1">Yes</option>
                                                                <option value="2" selected>No</option>
                                                            </select>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="codeLouCat1DslWrk == '1'">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <p>Was this due to a permanent closure of, or substantial layoff at a plant, facility, or enterprise?</p>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <select name="CodeLouCat2DslWrk" v-model="codeLouCat2DslWrk" v-validate:codeLouCat2DslWrk="['required']">
                                                                    <option value="" selected>- Select -</option>
                                                                    <option value="1">Yes</option>
                                                                    <option value="2">No</option>
                                                                </select>
                                                                <span></span>
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
                                                    <p>Are you interested in gaining employment as a software developer or in a software development-related position?</p>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <select name="InterestedTech" v-model="interestedTech" v-validate:interestedTech="['required']">
                                                                <option value="" selected>- Select -</option>
                                                                <option value="1">Yes</option>
                                                                <option value="2">No</option>
                                                                <option value="3">I am already employed in this area</option>
                                                            </select>
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="interestedTech == '1'">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <p>What are your plans for the training you'll receive through Code Louisville?  For example, what type of job are you interested in obtaining?</p>
                                                        <div class="row">
                                                            <div class="col-sm-6">
                                                                <textarea name="JobInterest" v-validate:jobInterest="['required']"></textarea>
                                                                <span></span>
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
                                                    <p>What is your annual household income?</p>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            $<input type="number" name="CodeLouAnnualIncome" v-validate:codeLouAnnualIncome="['required']">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div v-if="employmentStatus == '3' || employmentStatus == '4'">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <p>Are you formerly self-employed and now unemployed as a result of general economic conditions in the community in which you reside, or due to natural disaster?</p>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <select name="CodeLouCat3DslWrk" v-model="codeLouCat3DslWrk" v-validate:codeLouCat3DslWrk="['required']">
                                                                    <option value="" selected>- Select -</option>
                                                                    <option value="1">Yes</option>
                                                                    <option value="2">No</option>
                                                                </select>
                                                                <span></span>
                                                            </div>
                                                        </div>
                                                    </label>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <label>
                                                        <p>Have you been providing unpaid services to family members while dependent on the income of another family member, and are no longer supported by that income?</p>
                                                        <div class="row">
                                                            <div class="col-sm-4">
                                                                <select name="CodeLouCat4DslWrk" v-model="codeLouCat4DslWrk" v-validate:codeLouCat4DslWrk="['required']">
                                                                    <option value="" selected>- Select -</option>
                                                                    <option value="1">Yes</option>
                                                                    <option value="2">No</option>
                                                                </select>
                                                                <span></span>
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
                                                    <p>How many family members reside in your household?</p>
                                                    <div class="row">
                                                        <div class="col-sm-4">
                                                            <input type="number" name="CodeLouNumHouse" value="1" v-validate:codeLouNumHouse="['required']">
                                                            <span></span>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <p>What classroom locations are you available to attend?</p>
                                                <p><input type="checkbox" value="1" v-model="locLou" name="CodeLou_Lou"> &nbsp; Downtown Louisville</p>
                                                <p><input type="checkbox" value="1" v-model="locJeff" name="CodeLou_Jeff"> &nbsp; Jeffersonville, IN</p>
                                                <p><input type="checkbox" value="1" v-model="locLaGrange" name="CodeLou_LaGrange"> &nbsp; La Grange, KY</p>
                                                <input type="hidden" v-model="location" v-validate:location="['required']">
                                                <span></span>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <p><input type="checkbox" value="1" name="CodeLouCodeOfConduct" v-model="codeOfConduct"> &nbsp; I will adhere to the Code Louisville <a href="https://drive.google.com/file/d/0B28qs3pVLuXSTGhWbU1JWng0YWM/view" target="_blank">Code of Conduct</a></p>
                                                <input type="hidden" v-model="coc" v-validate:coc="['required']">
                                                <span></span>
                                            </div>
                                        </div>
                                        <hr>
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
                                        <div v-if="!$enroll.valid">
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-2">
                                                    <button type="button" class="button button-block disabled" @click="submitted = 'true'">Submit</button>
                                                </div>
                                                <div class="col-sm-4" v-if="submitted == 'true'">
                                                    <span class="required-alert">Please fill in ALL required fields</span>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </validator>
                            @else
                                Applications are temporarily on hold. We expect to be accepting new applications within a week; please check back soon.
                            @endif
                        </section>
                    @else
                        <section class="enrollment-form inset">
                            <p class="m0">Application is down. Please check back soon, we&rsquo;re working hard to fix this issue.</p>
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
        const vm = new Vue({
            el: '#enroll',
            data: {
                locLou: 0,
                locJeff: 0,
                locLaGrange: 0,
                codeOfConduct: 0,
                submitted: false,
                emailAlreadyExists: false
            },
            computed: {
                coc: function () {
                    return this.codeOfConduct == true ? true : null
                },
                location: function () {
                    if (this.locLou || this.locJeff || this.locLaGrange) {
                        return 'yes'
                    } else {
                        return ''
                    }
                },
                race: function () {
                    if (this.amerIndian || this.asian || this.black || this.white || this.islander || this.didNotIdentifyRace) {
                        return 'yes'
                    } else {
                        return ''
                    }
                },
                recTANF: function () {
                    return this.tRecTANF ? 'Y' : 'N'
                },
                recGeneralAsst: function () {
                    return this.tRecGeneralAsst ? 'Y' : 'N'
                },
                recOther: function () {
                    return this.tRecOther ? 'Y' : 'N'
                }
            },
            validators: {
                exists(val) {
                    if (/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(val)) {
                        return fetch(`/api/enrollments/exists?email=${val}`, {
                            method: 'get',
                            headers: {
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        })
                            .then(res => res.json())
                            .then(res => { 
                                if (res.exists) {
                                    // email exists, let the user know
                                    this.vm.emailAlreadyExists = true;
                                    return Promise.reject();
                                } else {
                                    // email does not exist
                                    this.vm.emailAlreadyExists = false;
                                    return Promise.resolve()
                                }
                            })
                    } else {
                        // not a valid email
                        this.vm.emailAlreadyExists = false;
                        return false
                    }
                }
            },
            methods: {
                onReset: function () {
                    this.$resetValidation()
                }
            }
        })
    </script>

@endsection
