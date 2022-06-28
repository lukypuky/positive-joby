@extends('navbar')
@section('index')
    <div class="container" style="text-align: center; width: 55%;">
        <div>
            <!-- nadpis -->
            <h1><span class="orangeObject">Pridaj sa k nám!</span> Čaká ťa skvelý job</h1>
            <!-- searchbox -->
        </div>
        <div>
            <div class="homePagePadding" style="display: flex; margin-left: 15px; align-items: center; cursor: pointer;">
                <div>
                    <img src="/img/reset.png" alt="#" width="30" height="30">
                </div>
                <div>
                    Resetovať filter
                </div>
                <div style="display: flex;">
                    <div>
                        <button onclick="toTilesLayout()">TILES</button>
                    </div>
                    <div>
                        <button onclick="toRowsLayout()">ROWS</button>
                    </div>
                </div>
            </div>
            <div style="display: flex;">
                <!-- CONTENT, filtre, dlazdice, riadky -->
                <div class="accordion homePagePadding" id="accordionExample" style=" width:30%;">
                    <div class="filterBackgroud staticBorder">
                        <div>
                            <h2 class="salaryHeading"><strong>Plat</strong></h2>
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
                    <div class="accordion-item accordionItem staticBorder">
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
                                @foreach ($allEmploymentTypes as $employmentType)
                                    <div>
                                        <input class="form-check-input checkboxMargin" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $employmentType->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem staticBorder">
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
                                @foreach ($experiences as $experience)
                                    <div>
                                        <input class="form-check-input checkboxMargin" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $experience->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem staticBorder">
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
                                @foreach ($homeoffices as $homeoffice)
                                    <div>
                                        <input class="form-check-input checkboxMargin" type="checkbox" value=""
                                            id="flexCheckDefault">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $homeoffice->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="homePagePadding" style="width:70%;">
                    <div>
                        <div class="row">
                            @foreach ($jobs as $job)
                                <div class="col col-sm-12 col-md-6 col-lg-6 jobObject staticBorder layoutClass">
                                    <div style="text-align: -webkit-center;"> {{-- webkit centre --}}
                                        <div class="jobTileObjectHeading">
                                            <div class="jobTileObjectHeadingImage">
                                                <img src="/img/job.png" alt=">User icons created by Freepik - Flaticon"
                                                    width="30" height="30">
                                            </div>
                                            <div class="jobTileObjectHeadingImageObject">
                                                <h4 class="jobTileObjectHeadingText">{{ $job->position_name }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="jobTileObjectFooter">
                                        <div class="jobTileObjectFooterSectionObject">
                                            <div class="jobObjectFooterSection">
                                                <img src="/img/briefcase.png" alt="#" width="30"
                                                    height="30" class="jobObjectFooterImage">
                                                <div class="jobObjectFooterText">
                                                    @foreach ($jobEmploymentTypes as $jobEmploymentType)
                                                        @if ($job->id === $jobEmploymentType->id_job)
                                                            @foreach ($allEmploymentTypes as $employmentType)
                                                                @if ($jobEmploymentType->id_employment_type === $employmentType->id)
                                                                    {{ $employmentType->name }}
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <div class="jobTileObjectFooterSectionObject">
                                            <div class="jobObjectFooterSection jobObjectFooterText">
                                                <img src="/img/euro.png" alt="#" width="30" height="30"
                                                    class="jobObjectFooterImage">
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
                                    </div>
                                </div>
                            @endforeach
                            {{-- //////////////////////////////////////////////////////////////////////////////// --}}
                            {{-- <div class="col col-sm-12 col-md-12 col-lg-12 jobObject staticBorder layoutClass">
                                <div class="jobRowObjectHeading">
                                    <div class="jobRowObjectHeadingImage">
                                        <img src="/img/job.png" alt=">User icons created by Freepik - Flaticon"
                                            width="30" height="30">
                                    </div>
                                    <div class="jobRowObjectHeadingImageObject">
                                        <h4 class="jobRowObjectHeadingText">Junior PHP Developer</h4>
                                    </div>
                                </div>
                                <div class="jobRowObjectFooter">
                                    <div class="jobRowObjectFooterSectionObject">
                                        <div class="jobObjectFooterSection jobObjectFooterText">
                                            <img src="/img/briefcase.png" alt="#" width="30" height="30"
                                                class="jobObjectFooterImage">
                                            <div>TPP, živnosť</div>
                                        </div>

                                    </div>
                                    <div class="jobRowObjectFooterSectionObject">
                                        <div class="jobObjectFooterSection jobObjectFooterText">
                                            <img src="/img/euro.png" alt="#" width="30" height="30"
                                                class="jobObjectFooterImage">
                                            <div>1200 - 1600 €</div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        {{-- <div class="row"> --}}
                        {{-- //////////////////////////////////////////////////////////////////////////////// --}}
                        {{-- <div class="col col-sm-12 col-md-6 col-lg-6 jobObject staticBorder">
                                <div>
                                    <div class="jobTileObjectHeading">
                                        <div class="jobTileObjectHeadingImage">
                                            <img src="/img/job.png" alt=">User icons created by Freepik - Flaticon"
                                                width="30" height="30">
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="jobTileObjectHeadingText">Junior PHP Developer</h4>
                                    </div>
                                </div>
                                <div class="jobtileObjectFooter">
                                    <div class="jobTileObjectFooterSectionObject">
                                        <div class="jobObjectFooterSection">
                                            <img src="/img/briefcase.png" alt="#" width="30" height="30"
                                                class="jobObjectFooterImage">
                                            <div>TPP, živnosť</div>
                                        </div>

                                    </div>
                                    <div class="jobTileObjectFooterSectionObject">
                                        <div class="jobObjectFooterSection">
                                            <img src="/img/euro.png" alt="#" width="30" height="30"
                                                class="jobObjectFooterImage">
                                            <div>1200 - 1600 €</div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
