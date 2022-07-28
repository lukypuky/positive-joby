@extends('navbar')
@section('index')
    <div class="pageImage"></div>
    <div class="container pageContent">
        <div class="jobsPageHeader">
            <div class="jobInfoTitle">
                <h1><span class="orangeText">Pridaj sa k nám!</span> Čaká ťa skvelý job</h1>
            </div>
            <div>
                <div class="search roundedCorners">
                    <i class="fa fa-user-o"></i>
                    <input type="text" class="form-control objectBorder roundedCorners" id="searchJobs"
                        placeholder="Vyhľadať pozíciu">
                    <button class="btn btn-primary orangeObject" id="searchJobsButton"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
        <div>
            <div class="row g-custom jobsHeadingButtons">
                <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                    <button class="jobHeadingResetButton roundedCorners" id="resetFilter">
                        <div><i class="fa fa-refresh fa-2x jobObjectFooterImage" aria-hidden="true"></i></div>
                        <div class="jobHeadingResetButtonText">
                            Resetovať filter
                        </div>
                    </button>
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8 jobHeadingDropdown">
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
                        <button id="toTilesButton" name="toTilesButton" class="layoutButton filter roundedCorners"
                            value="1"><i class="fa fa-th-large"></i></button>
                        <button id="toRowsButton" name="toRowsButton" class="layoutButton filter roundedCorners"
                            value="2"><i class="fa fa-list"></i></button>
                    </div>
                </div>
            </div>

            <div class="row g-custom jobFilter">
                <div class=" homePagePadding col-12 col-sm-12 col-md-12 col-lg-4" id="accordionExample">
                    <div class="filterBackgroud objectBorder roundedCorners">
                        <div>
                            <h2 class="salaryHeading"><strong>Plat</strong></h2>
                        </div>

                        <div class="jobSalary">
                            <form class="jobSalaryForm">
                                <label for="salaryFrom">od</label>
                                <input type="number" id="salaryFrom" name="salaryFrom"
                                    class="salaryWidth objectBorder roundedCorners filter" onchange="filterJobs()">
                                <label for="salaryTo">do</label>
                                <input type="number" id="salaryTo" name="salaryTo"
                                    class="salaryWidth objectBorder roundedCorners filter" onchange="filterJobs()">
                            </form>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem objectBorder roundedCorners">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                            <button class="accordion-button filterBackgroud" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseOne">
                                <strong>Druh pracovného pomeru</strong>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse filterBackgroud show"
                            aria-labelledby="panelsStayOpen-headingOne">
                            <div class="accordion-body accordionBody">
                                @foreach ($allEmploymentTypes as $employmentType)
                                    <div>
                                        <input class="form-check-input checkboxMargin employmentTypeCheckbox filter"
                                            type="checkbox" id="{{ $employmentType->id }}" onchange="filterJobs()">
                                        <label class="form-check-label" for="{{ $employmentType->id }}">
                                            {{ $employmentType->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem objectBorder roundedCorners">
                        <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                            <button class="accordion-button filterBackgroud" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="true"
                                aria-controls="panelsStayOpen-collapseTwo">
                                <strong>Skúsenosti</strong>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse filterBackgroud show"
                            aria-labelledby="panelsStayOpen-headingTwo">
                            <div class="accordion-body accordionBody">
                                @foreach ($experiences as $experience)
                                    <div>
                                        <input class="form-check-input checkboxMargin experienceCheckbox filter"
                                            type="checkbox" id="{{ $experience->name }}" onchange="filterJobs()">
                                        <label class="form-check-label" for="{{ $experience->name }}">
                                            {{ $experience->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item accordionItem objectBorder roundedCorners">
                        <h2 class="accordion-header" id="panelsStayOpen-headingThree">
                            <button class="accordion-button filterBackgroud" type="button" data-bs-toggle="collapse"
                                data-bs-target="#panelsStayOpen-collapseThree" aria-expanded="false"
                                aria-controls="panelsStayOpen-collapseThree">
                                <strong>Práca z domu</strong>
                            </button>
                        </h2>
                        <div id="panelsStayOpen-collapseThree" class="accordion-collapse collapse filterBackgroud show"
                            aria-labelledby="panelsStayOpen-headingThree">
                            <div class="accordion-body accordionBody">
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
                        <div class="row gy-2 gx-3" id="row">
                        </div>

                        <div>
                            <nav>
                                <ul class="pagination"></ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        let layout = 2; //1 = tile, 2 = row
        let order = 1; //1 = asc, 2 = desc
        let page = 1;

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
                    page: 1,
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
                },
                error: function(xhr, status, error) {
                    $("#errorModalCenter").modal('show')
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

        function setPage(pageNumber) {
            page = pageNumber;
            filterJobs();
        }

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
                    page: page,
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
                    deRenderPagination();
                    renderPagination();
                },
                error: function(xhr, status, error) {
                    $("#errorModalCenter").modal('show')
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
                    page: page,
                    layout: layout,
                    order: order,
                },
                success: function(res) {
                    $(".jobObject").remove();
                    $('#row').html(res);
                    deRenderPagination();
                    renderPagination();

                },
                error: function(xhr, status, error) {
                    $("#errorModalCenter").modal('show')
                }
            });
        });

        function deRenderPagination() {
            $('.paginationItem').remove();
            page = 1;
        }

        function renderPagination() {
            const paginationContainer = document.getElementsByClassName('pagination');
            let divContent = $('#jobsCount').text();
            let actualPage = $('#actualPage').text();

            for (let x = 0; x < divContent / 10; x++) {
                const newLi = document.createElement('li');
                const newSpan = document.createElement('span');

                newLi.classList.add('page-item');
                newLi.classList.add('paginationItem');
                newLi.addEventListener("click", function() {
                    setPage(x + 1);
                });

                newSpan.classList.add('page-link');
                newSpan.innerHTML += x + 1;

                paginationContainer[0].appendChild(newLi);
                newLi.appendChild(newSpan);

                if (actualPage == x + 1) {
                    newLi.classList.add('active');
                }
            }
        }

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
                        page: page,
                        searchRequest: searchRequest,
                        layout: 1,
                        order: order,
                    },
                    success: function(res) {
                        $(".jobObject").remove();
                        $('#row').html(res);
                        deRenderPagination();
                        renderPagination();
                    },
                    error: function(xhr, status, error) {
                        $("#errorModalCenter").modal('show')
                    }
                });
            } else {
                $.ajax({
                    method: 'POST',
                    url: "{{ route('searchJobs') }}",
                    dataType: 'html',
                    data: {
                        '_token': '{{ csrf_token() }}',
                        page: page,
                        searchRequest: searchRequest,
                        layout: 2,
                        order: order,
                    },
                    success: function(res) {
                        $(".jobObject").remove();
                        $('#row').html(res);
                        deRenderPagination();
                        renderPagination();
                    },
                    error: function(xhr, status, error) {
                        $("#errorModalCenter").modal('show')
                    }
                });
            }
        });
    </script>
@endsection

@section('errorModal')
    <!-- Modal -->
    <div class="modal fade" id="errorModalCenter" tabindex="-1" role="dialog" aria-labelledby="errorModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="errorModalLongTitle">Chyba</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Ups, niečo sa nepodarilo, skúste to znova.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
                </div>
            </div>
        </div>
    </div>
@endsection
