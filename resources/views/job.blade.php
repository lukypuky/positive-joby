@extends('navbar')
@section('job')
    <div class="container pageContent">
        <div>
            <div>
                {{-- image missing --}}
            </div>
            <div style="text-align: left; margin-bottom: 30px;">
                <a href="{{ route('getIndex') }}" style="color: black; text-decoration: none;"><i
                        class="fa fa-arrow-left jobObjectFooterImage" aria-hidden="true"></i>Späť na ponuku jobov</a>
            </div>
            <div style="margin-bottom: 30px;">
                <h1>{{ $job->position_name }}</h1>
            </div>
            <div>
                <div class="flex2">
                    <div class="flex-items" style="align-items: center;">
                        <div class="jobObjectFooterImage jobPageHeaderInfo">
                            <i class="fa fa-briefcase jobObjectFooterImage centerIcon" aria-hidden="true"></i>
                            @foreach ($jobEmploymentTypes as $jobEmploymentType)
                                @if ($job->id === $jobEmploymentType->id_job)
                                    @foreach ($allEmploymentTypes as $employmentType)
                                        @if ($jobEmploymentType->id_employment_type === $employmentType->id)
                                            {{ $employmentType->name }},
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </div>
                        <div class="jobPageHeaderInfo">
                            <i class="fa fa-eur jobObjectFooterImage centerIcon" aria-hidden="true"></i>
                            @foreach ($salaryTypes as $salaryType)
                                @if ($job->id_salary_type === $salaryType->id && ($salaryType->id === 1 || $salaryType->id === 2))
                                    <div>{{ $job->salary_from }} € {{ $salaryType->name }} </div>
                                @elseif($job->id_salary_type === $salaryType->id && $salaryType->id === 3)
                                    <div>{{ $salaryType->name }} {{ $job->salary_from }} €</div>
                                @elseif($job->id_salary_type === $salaryType->id && $salaryType->id === 4)
                                    <div>{{ $job->salary_from }} € - {{ $job->salary_to }} €</div>
                                @endif
                            @endforeach
                        </div>

                    </div>
                    <div class="flex-items">
                        <button class="btn btn-primary orangeObject orangeButtons" id="toFormBtn">MÁM
                            ZÁUJEM</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align: left;">
            <div class="jobInfoObject">
                <div class="jobInfoHeading">
                    <i class="fa fa-eur jobObjectFooterImage centerIcon" aria-hidden="true"></i>
                    <h2>Čo budeš robiť?</h2>
                </div>
                <div class="jobInfoText">
                    <div>
                        {{ $job->description }}
                    </div>
                </div>
            </div>
            <div class="jobInfoObject">
                <div class="jobInfoHeading">
                    <i class="fa fa-eur jobObjectFooterImage centerIcon" aria-hidden="true"></i>
                    <h2>Mzdové podmienky</h2>
                </div>
                <div class="jobInfoText">
                    <div>
                        {{ $job->salary_conditions }}
                    </div>
                </div>
            </div>
            <div class="jobInfoObject">
                <div class="jobInfoHeading">
                    <i class="fa fa-eur jobObjectFooterImage centerIcon" aria-hidden="true"></i>
                    <h2>Čo od teba očakávame?</h2>
                </div>
                <div class="jobInfoText">
                    <div>
                        {{ $job->expectation }}
                    </div>
                </div>
            </div>
            <div class="jobInfoObject">
                <div class="jobInfoHeading">
                    <i class="fa fa-eur jobObjectFooterImage centerIcon" aria-hidden="true"></i>
                    <h2>Základné benefity</h2>
                </div>
                <div class="jobInfoText">
                    <div>
                        {{ $job->benefits }}
                    </div>
                </div>
            </div>
            <div class="jobInfoObject">
                <div class="jobInfoHeading">
                    <i class="fa fa-eur jobObjectFooterImage centerIcon" aria-hidden="true"></i>
                    <h2>Odoslať žiadosť</h2>
                </div>
                <div class="jobInfoText">
                    <div>
                        <div style="margin-bottom: 15px;">Máš záujem o toto miesto? Vyplň formulár a budeme ťa
                            kontaktovať.</div>
                        <form action="{{ route('sendMail') }}" method="POST" enctype="multipart/form-data"
                            id="contactForm">
                            @csrf

                            <input type="hidden" name="job" value="{{ $job->id }}">
                            <input type="hidden" name="formType" value="1">

                            <div class="row formInputs">
                                <div class="col col-12 col-sm-12 col-md-4 col-lg-4">
                                    <div>
                                        <input type="text" class="form-control jobInfoInput" id="nameSurname"
                                            name="nameSurname" placeholder="Meno a priezvisko">
                                    </div>
                                    <div>
                                        <input type="text" class="form-control jobInfoInput" id="phone"
                                            name="phone" placeholder="Telefón">
                                    </div>
                                    <div>
                                        <input type="email" class="form-control jobInfoInput" id="email"
                                            name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col col-12 col-sm-12 col-md-8 col-lg-8">
                                    <div>
                                        <textarea class="form-control jobInfoInput jobInfoTextArea" placeholder="Prečo práve ty?" name="message" required></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="contactFormAttachment">
                                <input type="file" name="fileUpload" hidden id="fileUpload">
                                <label for="fileUpload" class="contactFormAttachmentBtn"><i
                                        class="fa fa-user-o jobObjectFooterImage"></i>Pridať
                                    prílohu</label>
                                <span id="fileChosen" class="contactFormAttachmentText"></span>
                            </div>
                            <div>
                                <div>
                                    <button class="btn btn-primary orangeObject orangeButtons g-recaptcha"
                                        data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit'
                                        data-action='submit'>ODOSLAŤ ŽIADOSŤ</button>
                                </div>
                                <div>
                                    <input class="form-check-input checkboxMargin jobInfoInput" type="checkbox"
                                        name="conditions" id="conditionsCheckBox" required>
                                    <label class="form-check-label" for="flexCheckDefault">Vyhlasujem, že som sa
                                        oboznámil s
                                        <a href="#">Podmienkami spracúvania a ochrany osobných údajov</a></label>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        const actualBtn = document.getElementById('fileUpload');

        const fileChosen = document.getElementById('fileChosen');

        actualBtn.addEventListener('change', function() {
            fileChosen.textContent = this.files[0].name
        })

        function onSubmit(token) {
            document.getElementById("contactForm").submit();
        }


        $("#toFormBtn").click(function() {
            $('html, body').animate({
                scrollTop: $("#contactForm").offset().top
            }, 10);
        });
    </script>
@endsection
