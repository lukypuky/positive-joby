@extends('navbar')
@section('contact')
    <div class="pageHeading">
        <h1 class="heading">Kontakt</h1>
    </div>
    <div class="container pageContent">
        <div class="contactInfo">
            <div class="contactPageSubHeading">
                <h2 class="heading">Sme tu pre Vás v pracovnej dobe od 8:00 do 15:30</h2>
            </div>
            <div class="row contactPageInfo">
                <a href="tel:+421902600700" class="col-12 col-sm-12 col-md-4 col-lg-4 contact">
                    <div class="contactObjectImage inner">
                        <i class="fa fa-phone fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="inner innerText">
                        <div>+421 902 600 700</div>
                    </div>
                </a>
                <a href="mailto:info@positive.sk" class="col-12 col-sm-12 col-md-4 col-lg-4 contact">
                    <div class="contactObjectImage inner">
                        <i class="fa fa-envelope-o fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="inner innerText">
                        <div>info@positive.sk</div>
                    </div>
                </a>
                <div class="col-12 col-sm-12 col-md-4 col-lg-4 contact">
                    <div class="contactObjectImage inner">
                        <i class="fa fa-map-marker fa-3x" aria-hidden="true"></i>
                    </div>
                    <div class="inner innerText">
                        <div>Škultétyho 18, Bratislava</div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="contactPageSubHeading">
                <h2 class="heading">Dohodnime si stretnutie, alebo konferenčný hovor.</h2>
            </div>
            <div class="contactPageForm">
                <form action="{{ route('sendMail') }}" method="POST" enctype="multipart/form-data" id="contactForm">
                    @csrf

                    <input type="hidden" name="formType" value="2">

                    <div class="row formInputs">
                        <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                            <div>
                                <input type="text" class="form-control roundedCorners jobInfoInput" id="nameSurname"
                                    name="nameSurname" placeholder="Meno a priezvisko" required>
                            </div>
                            <div>
                                <input type="text" class="form-control roundedCorners jobInfoInput" id="phone"
                                    name="phone" placeholder="Telefón" required>
                                @error('phone')
                                    <div class="formInputError">Zadajte platné telefónne číslo!</div>
                                @enderror
                            </div>
                            <div>
                                <input type="email" class="form-control roundedCorners jobInfoInput" id="email"
                                    name="email" placeholder="Email" required>
                                @error('email')
                                    <div class="formInputError">Zadajte platný email!</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                            <div>
                                <textarea class="form-control roundedCorners jobInfoInput jobInfoTextArea"
                                    placeholder="Dobrý deň, mám záujem o spoluprácu.&#10;Kontaktujte ma prosím." name="message" required></textarea>
                                @error('message')
                                    <div class="formInputError">Zadajte aspoň 6 znakov!</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="contactFormAttachment">
                        <input type="file" name="fileUpload" hidden id="fileUpload">
                        <label for="fileUpload" class="contactFormAttachmentBtn"><i
                                class="fa fa-user-o jobObjectFooterImage"></i>Pridať
                            prílohu</label>
                        <span id="fileChosen" class="contactFormAttachmentText orangeText"></span>
                    </div>
                    <div>
                        <div>
                            <button class="btn btn-primary orangeObject orangeButtons g-recaptcha"
                                data-sitekey="reCAPTCHA_site_key" data-callback='onSubmit'
                                data-action='submit'>ODOSLAŤ</button>
                        </div>
                        <div>
                            <input class="form-check-input checkboxMargin jobInfoInput conditionCheckbox" type="checkbox"
                                name="conditionsCheckBox" id="conditionsCheckBox" required>
                            <label class="form-check-label conditionsCheckboxLabel" for="conditionsCheckBox">Vyhlasujem, že
                                som sa
                                oboznámil s
                                <a href="/storage/podmienky-spracuvania-ou.pdf"
                                    title="Podmienkami spracúvania a ochrany osobných údajov"
                                    class="textDecoration">Podmienkami
                                    spracúvania a ochrany osobných údajov</a></label>
                        </div>
                    </div>
                </form>
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
    </script>
@endsection

@section('contactTags')
    <meta name="description"
        content="Softvérovú spoločnosť Positive nájdete v Bratislave na ulici Škultétyho 18. Dohodnime si stretnutie alebo konferenčný hovor.">
    <meta name="keywords"
        content="kontakt, Positive, softvérová spoločnosť Positive, stretnutie, finančné sprostredkovanie, finančný agent, softvér a služby pre finančný trh">
    <meta name="author" content="Positive s.r.o. © 2022">
@endsection

@section('contactFbTags')
    <meta property="og:title" content="Kontakt">
    <meta property="og:description"
        content="Softvérovú spoločnosť Positive nájdete v Bratislave na ulici Škultétyho 18. Dohodnime si stretnutie alebo konferenčný hovor.">
    <meta property="og:image" content="https://positive.sk//storage/settings/December2020/HML6QBJokpY50ddY04s1.jpg">
    <meta property="og:url" content="http://joby.positive.sk/kontakt">
    <meta property="og:type" content="website">
@endsection
