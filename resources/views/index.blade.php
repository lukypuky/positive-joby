@extends('navbar')
@section('index')
    <div class="container pageContent">
        <div style="border: 1px solid black;">
            <div>
                {{-- image missing --}}
            </div>
            <div style="margin-bottom: 30px;">
                <h1><span class="orangeText">Pridaj sa k nám!</span> Čaká ťa skvelý job</h1>
            </div>
            <div>
                <div class="search rounded">
                    <i class="fa fa-user-o"></i>
                    <input type="text" class="form-control border rounded" id="searchJobs" placeholder="Vyhľadať pozíciu">
                    <button class="btn btn-primary orangeObject" id="searchJobsButton"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div style="border: 1px solid black;">
            <div class="row g-custom" style="align-items: center; margin-top: 25px; width: 100%;">
                <div class="col col-12 col-sm-12 col-md-4 col-lg-4">
                    <button style="display: flex; background: transparent;" id="resetFilter">
                        <div><img src="/img/reset.png" alt="#" width="30" height="30"></div>
                        <div style="align-self: center;">
                            Resetovať filter
                        </div>
                    </button>
                </div>
                <div class="col col-12 col-sm-12 col-md-8 col-lg-8"
                    style="justify-content: right; display: flex; padding: 10px;">
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Zoradiť podľa
                        </a>

                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="#" id="ascendingLayout">Názvu - vzostupne</a></li>
                            <li><a class="dropdown-item" href="#" id="descendingLayout">Názvu - zostupne</a></li>
                        </ul>
                    </div>
                    <div class="layoutButtons">
                        <button id="toTilesButton" name="toTilesButton" class="layoutButton filter" value="1"><i
                                class="fa fa-th-large"></i></button>
                        <button id="toRowsButton" name="toRowsButton" class="layoutButton filter" value="2"><i
                                class="fa fa-list"></i></button>
                    </div>
                </div>
            </div>

            <div class="row g-custom" style="width: 100%;">
                <div class=" homePagePadding col-12 col-sm-12 col-md-12 col-lg-4" id="accordionExample">
                    <div class="filterBackgroud border rounded">
                        <div>
                            <h2 class="salaryHeading"><strong>Plat</strong></h2>
                        </div>

                        <div style="padding: 1rem 1.25rem;">
                            <form style="display: flex;">
                                <label for="salaryFrom">od</label>
                                <input type="number" id="salaryFrom" name="salaryFrom"
                                    class="salaryWidth border rounded filter" onchange="filterJobs()">
                                <label for="salaryTo">do</label>
                                <input type="number" id="salaryTo" name="salaryTo"
                                    class="salaryWidth border rounded filter" onchange="filterJobs()">
                            </form>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem border rounded">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button filterBackgroud" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                <strong>Druh pracovného pomeru</strong>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse filterBackgroud show"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body" style="text-align:left">
                                @foreach ($allEmploymentTypes as $employmentType)
                                    <div>
                                        <input class="form-check-input checkboxMargin employmentTypeCheckbox filter"
                                            type="checkbox" id="{{ $employmentType->id }}" onchange="filterJobs()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $employmentType->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem border rounded">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button filterBackgroud" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseTwo">
                                <strong>Skúsenosti</strong>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse filterBackgroud show"
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body" style="text-align:left">
                                @foreach ($experiences as $experience)
                                    <div>
                                        <input class="form-check-input checkboxMargin experienceCheckbox filter"
                                            type="checkbox" id="{{ $experience->name }}" onchange="filterJobs()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $experience->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem border rounded">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button filterBackgroud" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                <strong>Práca z domu</strong>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse filterBackgroud show"
                            aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body" style="text-align:left">
                                @foreach ($homeoffices as $homeoffice)
                                    <div>
                                        <input class="form-check-input checkboxMargin homeofficeCheckbox filter"
                                            type="checkbox" id="{{ $homeoffice->name }}" onchange="filterJobs()">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            {{ $homeoffice->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="homePagePadding col-12 col-sm-12 col-md-12 col-lg-8">
                    <div>
                        <div class="row g-custom" id="row">
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
        let layout = 2; //1 = tile, 2 = row
        let order = 1; //1 = asc, 2 = desc

        //reset filtra
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
                    layout: layout,
                    order: order,
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

        //zobrazenie jobov v podobe riadkov
        $("#toRowsButton").on("click", function(e) {
            e.preventDefault();
            layout = $(this).val();
            filterJobs();
        });

        // zobrazenie jobov v podobe dlazdic
        $("#toTilesButton").on("click", function(e) {
            e.preventDefault();
            layout = $(this).val();
            filterJobs();
        });

        $("#ascendingLayout").on("click", function(e) {
            e.preventDefault();
            order = 1;
            filterJobs();
        });

        $("#descendingLayout").on("click", function(e) {
            e.preventDefault();
            order = 2;
            filterJobs();
        });

        //filter
        function filterJobs() {
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
                    layout: layout,
                    order: order,
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
        }

        // defaultne zobrazenie jobov
        $(document).ready(function() {

            $.ajax({
                method: 'POST',
                url: "{{ route('getJobLayout') }}",
                dataType: 'html',
                data: {
                    '_token': '{{ csrf_token() }}',
                    layout: layout,
                    order: order,
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
                        order: order,
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
                        order: order,
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
