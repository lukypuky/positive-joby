@extends('navbar')
@section('index')
    <div class="container pageContent">
        <div>
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
                <div class="flex-items">
                    <button style="display: flex; background: transparent;" id="resetFilter">
                        <div><img src="/img/reset.png" alt="#" width="30" height="30"></div>
                        <div style="align-self: center;">
                            Resetovať filter
                        </div>
                    </button>
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
                        <button id="toTilesButton" class="layoutButton"><i class="fa fa-th-large"></i></button>
                        <button id="toRowsButton" class="layoutButton"><i class="fa fa-list"></i></button>
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
                                <input type="number" id="salaryFrom" name="salaryFrom" class="salaryWidth filter">
                                <label for="salaryTo">do</label>
                                <input type="number" id="salaryTo" name="salaryTo" class="salaryWidth filter">
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
                                        <input class="form-check-input checkboxMargin employmentTypeCheckbox filter"
                                            type="checkbox" id="{{ $employmentType->id }}">
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
                                        <input class="form-check-input checkboxMargin experienceCheckbox filter"
                                            type="checkbox" id=" {{ $experience->name }} ">
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
                                        <input class="form-check-input checkboxMargin homeofficeCheckbox filter"
                                            type="checkbox" id="{{ $homeoffice->name }}">
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
                        <div class="row" id="row">
                        </div>

                        {{-- @if ($jobs->count())
                            <div>
                                {{ $jobs->links() }}
                            </div>
                        @else
                            <div>
                                Žiadne joby.
                            </div>
                        @endif --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        // filter
        $("#resetFilter").on("click", function(e) {
            e.preventDefault();

            $(".experienceCheckbox").prop("checked", false);
            $(".homeofficeCheckbox").prop("checked", false);
            $(".employmentTypeCheckbox").prop("checked", false);
            $('#salaryFrom').val('');
            $('#salaryTo').val('');

            $.ajax({
                method: 'POST',
                url: "{{ route('getJobFiltred') }}",
                dataType: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    layout: 2,
                    experiences: [],
                    homeoffices: [],
                    employmentTypes: [],
                    salaryFrom: 0,
                    salaryTo: 0,
                },
                success: function(res) {
                    $(".jobObject").remove();
                    $('#row').html(res);
                }
            });
        });

        $(".filter").change(function() {
            let experiences = [];
            let homeoffices = [];
            let employmentTypes = [];
            let salaryFrom = 0;
            let salaryTo = 0;

            $('.experienceCheckbox').each(function(index, item) {
                if (item.checked) {
                    experiences.push(item.id);

                }
            });

            $('.homeofficeCheckbox').each(function(index, item) {
                if (item.checked) {
                    homeoffices.push(item.id);
                }
            });

            $('.employmentTypeCheckbox').each(function(index, item) {
                if (item.checked) {
                    employmentTypes.push(item.id);
                }
            });

            salaryFrom = $('#salaryFrom').val();
            salaryTo = $('#salaryTo').val();

            $.ajax({
                method: 'POST',
                url: "{{ route('getJobFiltred') }}",
                dataType: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    layout: 2,
                    experiences: experiences,
                    homeoffices: homeoffices,
                    employmentTypes: employmentTypes,
                    salaryFrom: salaryFrom,
                    salaryTo: salaryTo,
                },
                success: function(res) {
                    $(".jobObject").remove();
                    $('#row').html(res);
                }
            });
        });

        // defaultne zobrazenie jobov
        $(document).ready(function() {

            $.ajax({
                method: 'POST',
                url: "{{ route('getJobLayout') }}",
                dataType: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    layout: 2,
                },
                success: function(res) {
                    $(".jobObject").remove();
                    $('#row').html(res);
                }
            });
        });

        // zobrazenie jobov v podobe dlazdic
        $("#toTilesButton").on("click", function(e) {
            e.preventDefault();

            $.ajax({
                method: 'POST',
                url: "{{ route('getJobLayout') }}",
                dataType: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    layout: 1,
                },
                success: function(res) {
                    $(".jobObject").remove();
                    $('#row').html(res);
                }
            });
        });

        //zobrazenie jobov v podobe riadkov
        $("#toRowsButton").on("click", function(e) {
            e.preventDefault();

            $.ajax({
                method: 'POST',
                url: "{{ route('getJobLayout') }}",
                dataType: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    layout: 2,
                },
                success: function(res) {
                    $(".jobObject").remove();
                    $('#row').html(res);
                }
            });
        });

        // search job
        $("#searchJobsButton").on("click", function(e) {
            e.preventDefault();
            let searchRequest = $("#searchJobs").val();

            if ($("div").hasClass("jobTileObjectHeading")) {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('searchJobs') }}",
                    dataType: 'html',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        searchRequest: searchRequest,
                        layout: 1,
                    },
                    success: function(res) {
                        $(".jobObject").remove();
                        $('#row').html(res);
                    }
                });
            } else {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('searchJobs') }}",
                    dataType: 'html',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        searchRequest: searchRequest,
                        layout: 2,
                    },
                    success: function(res) {
                        $(".jobObject").remove();
                        $('#row').html(res);
                    }
                });
            }
        });
    </script>
@endsection
