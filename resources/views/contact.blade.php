@extends('navbar')
@section('contact')
    <div style="text-align: center; background-color: #f5f4f2; padding: 30px;">
        <h1>Kontakt</h1>
    </div>
    <div class="container pageContent">
        <div class="contactInfo">
            <div class="contactPageSubHeading">
                <h2>Sme tu pre Vás v pracovnej dobre od 8:00 do 15:30</h2>
            </div>
            <div class="row contactPageInfo">
                <div class="col col-sm-12 col-md-4 col-lg-4 contact">
                    <div class="contactObjectImage inner">
                        <img src="/img/job.png" alt="#" width="30" height="30">
                    </div>
                    <div class="inner innerText">
                        <div class="text_blue">+421 902 600 700</div>
                    </div>
                </div>
                <div class="col col-sm-12 col-md-4 col-lg-4 contact">
                    <div class="contactObjectImage inner">
                        <img src="/img/job.png" alt="#" width="30" height="30">
                    </div>
                    <div class="inner innerText">
                        <div class="text_blue">info@positive.sk</div>
                    </div>
                </div>
                <div class="col col-sm-12 col-md-4 col-lg-4 contact">
                    <div class="contactObjectImage inner">
                        <img src="/img/job.png" alt="#" width="30" height="30">
                    </div>
                    <div class="inner innerText">
                        <div class="text_blue">Škultétyho 18, Bratislava</div>
                    </div>
                </div>
            </div>
        </div>

        <div>
            <div class="contactPageSubHeading">
                <h2>Dohodnime si stretnutie, alebo konferenčný hovor.</h2>
            </div>
            <div class="contactPageForm">
                <form action="{{ route('sendMail') }}" method="POST" enctype="multipart/form-data" id="contactForm">
                    @csrf

                    <input type="hidden" name="formType" value="2">

                    <div class="row formInputs">
                        <div class="col col-12 col-sm-12 col-md-4 col-lg-4">
                            <div>
                                <input type="text" class="form-control jobInfoInput" id="nameSurname" name="nameSurname"
                                    placeholder="Meno a priezvisko">
                            </div>
                            <div>
                                <input type="text" class="form-control jobInfoInput" id="phone" name="phone"
                                    placeholder="Telefón">
                            </div>
                            <div>
                                <input type="email" class="form-control jobInfoInput" id="email" name="email"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="col col-12 col-sm-12 col-md-8 col-lg-8">
                            <div>
                                <textarea class="form-control jobInfoInput jobInfoTextArea"
                                    placeholder="Dobrý deň, mám záujem o spoluprácu.&#10;Kontaktujte ma prosím." name="message" required></textarea>
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
                                data-action='submit'>ODOSLAŤ</button>
                        </div>
                        <div>
                            <input class="form-check-input checkboxMargin jobInfoInput" type="checkbox" name="conditions"
                                id="conditionsCheckBox" required>
                            <label class="form-check-label" for="flexCheckDefault">Vyhlasujem, že som sa
                                oboznámil s
                                <a href="#">Podmienkami spracúvania a ochrany osobných údajov</a></label>
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
