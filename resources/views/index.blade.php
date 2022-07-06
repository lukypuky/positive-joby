@extends('navbar')
@section('index')
    <?php $layoutValue = 0; ?>

    <div class="container" style="text-align: center; width: 55%;">
        <div style="margin-top: 60px;">
            <div>
                {{-- image missing --}}
            </div>
            <div style="margin-bottom: 30px;">
                <h1><span class="orangeText">Pridaj sa k nám!</span> Čaká ťa skvelý job</h1>
            </div>
            <div>
                <div class="search">
                    <i class="fa fa-user-o"></i>
                    <input type="text" class="form-control" id="searchJobs" placeholder="Vyhľadať pozíciu">
                    <button class="btn btn-primary orangeObject" id="searchJobsButton"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div>
            <div class="flex2" style="margin-left: 15px; align-items: center; margin-top: 25px; margin-bottom: 5px;">
                <div style="cursor: pointer;" class="flex-items">
                    <div>
                        <img src="/img/reset.png" alt="#" width="30" height="30">
                    </div>
                    <div style="align-self: center;">
                        Resetovať filter
                    </div>
                </div>
                <div class="flex-items">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Zoradiť podľa
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </div>
                    <div class="layoutButtons">
                        <button onclick="toTilesLayout({{ $layoutValue }})" id="toTilesButton" class="layoutButton"><i
                                class="fa fa-th-large"></i></button>
                        <button onclick="toRowsLayout({{ $layoutValue }})" id="toRowsButton" class="layoutButton"><i
                                class="fa fa-list"></i></button>
                    </div>
                </div>
            </div>
            <div style="display: flex;">
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
                                <?php $jobData = [
                                    'job' => $job,
                                    'jobEmploymentTypes' => $jobEmploymentTypes,
                                    'allEmploymentTypes' => $allEmploymentTypes,
                                    '$salaryTypes' => $salaryTypes,
                                ]; ?>

                                @include('row', $jobData)
                                {{-- @include('tile', $jobData) --}}


                                {{-- <div class="col col-sm-12 col-md-6 col-lg-6 jobObject staticBorder layoutClass">
                                    <div style="text-align: -webkit-center;">
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
                                </div> --}}
                            @endforeach
                        </div>

                        @if ($jobs->count())
                            <div>
                                {{ $jobs->links() }}
                            </div>
                        @else
                            <div>
                                Žiadne joby.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $("#toTilesButton").on("click", function(e) {
            e.preventDefault();
            $(".jobObject").remove();

            $.ajax({
                method: 'POST',
                url: "{{ route('getJobTiles') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                },
                success: function(res) {
                    console.log(res);
                }
            });
        });

        $("#toRowsButton").on("click", function(e) {
            e.preventDefault();
            $(".jobObject").remove();
        });

        $("#searchJobsButton").on("click", function(e) {
            e.preventDefault();
            let searchRequest = $("#searchJobs").val();

            $.ajax({
                method: 'POST',
                url: "{{ route('searchJobs') }}",
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    searchRequest: searchRequest,
                },
                success: function(res) {
                    console.log(res);
                }
            });
        });
    </script>
@endsection
