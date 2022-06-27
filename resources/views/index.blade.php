@extends('navbar')
@section('index')
    <div class="container" style="text-align: center;">
        <div>
            <!-- nadpis -->
            <h1><span class="orangeObject">Pridaj sa k nám!</span> Čaká ťa skvelý job</h1>
            <!-- searchbox -->
        </div>
        <div>
            <div>
                <!-- nadpis, searchbox -->
            </div>
            <div style="display: flex;">
                <!-- CONTENT, filtre, dlazdice, riadky -->
                <div class="accordion homePagePadding" id="accordionExample" style=" width:30%;">
                    <div class="filterBackgroud border">
                        <div>
                            <h2 class="salaryHeading"><strong>Plot</strong></h2>
                        </div>

                        <div style="padding: 1rem 1.25rem;">
                            <form style="display: flex;">
                                <label for="salaryFrom">od</label>
                                <input type="number" id="salaryFrom" name="salaryFrom" class="salaryWidth">
                                <label for="salaryTo">do</label>
                                <input type="number" id="salaryTo" name="salaryTo" class="salaryWidth">
                            </form>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem border">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed filterBackgroud" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                aria-controls="collapseOne">
                                <strong>Druh pracovného pomeru</strong>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show filterBackgroud"
                            aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="text-align:left">
                                <div>
                                    <input class="form-check-input checkboxMargin" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Default checkbox
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input checkboxMargin" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Default checkbox
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem border">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed filterBackgroud" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true"
                                aria-controls="collapseTwo">
                                <strong>Skúsenosti</strong>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse show filterBackgroud"
                            aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="text-align:left">
                                <div>
                                    <input class="form-check-input checkboxMargin" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Default checkbox
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input checkboxMargin" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Default checkbox
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem border">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed filterBackgroud" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true"
                                aria-controls="collapseThree">
                                <strong>Práca z domu</strong>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse show filterBackgroud"
                            aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                            <div class="accordion-body" style="text-align:left">
                                <div>
                                    <input class="form-check-input checkboxMargin" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Default checkbox
                                    </label>
                                </div>
                                <div>
                                    <input class="form-check-input checkboxMargin" type="checkbox" value=""
                                        id="flexCheckDefault">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Default checkbox
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="homePagePadding" style="width:70%;">
                    <div>
                        <div class="row">
                            <div class="col col-sm-12 col-md-6 col-lg-6 grid border" style="">
                                <div>
                                    <div style="display: flex; justify-content: center;">
                                        <div
                                            style="height: 70px; width: 70px; border-radius: 50%; background-color: #f8f4f4; display: flex; align-items: center; justify-content: center;">
                                            <img src="/img/job.png" alt=">User icons created by Freepik - Flaticon"
                                                width="30" height="30">
                                        </div>
                                    </div>
                                    <div>
                                        <h4 style="text-decoration: underline;">Junior PHP Developer</h4>
                                    </div>
                                </div>
                                <div>
                                    <div
                                        style="display: flex; justify-content: center; background-color: #f8f4f4; border-radius: 20px; margin-bottom: 10px;">
                                        <div style="align-items: center; display:flex">
                                            <img src="/img/briefcase.png" alt="#" width="30" height="30"
                                                style="margin-right: 15px;">
                                            <div>TPP, živnosť</div>
                                        </div>

                                    </div>
                                    <div
                                        style="display: flex; justify-content: center; background-color: #f8f4f4; border-radius: 20px; margin-bottom: 10px;">
                                        <div style="align-items: center; display:flex">
                                            <img src="/img/euro.png" alt="#" width="30" height="30"
                                                style="margin-right: 15px;">
                                            <div>1200 - 1600 €</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6 grid border">
                                Column2
                            </div>
                            <div class="col col-sm-12 col-md-6 col-lg-6 grid border">
                                Column3
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
