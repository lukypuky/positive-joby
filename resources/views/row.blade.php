@foreach ($jobs as $job)
    <div class="col col-sm-12 col-md-12 col-lg-12 jobObject staticBorder"
        onclick="location.href = '/{{ $job->slug }}'">
        <div style="text-align: -webkit-center;">
            <div class="jobRowObjectHeading">
                <div class="jobRowObjectHeadingImage">
                    <img src="/img/job.png" alt=">User icons created by Freepik - Flaticon" width="30" height="30">
                </div>
                <div class="jobRowObjectHeadingImageObject">
                    <h4 class="jobRowObjectHeadingText">{{ $job->position_name }}</h4>
                </div>
            </div>
        </div>
        <div class="jobRowObjectFooter">
            <div class="jobRowObjectFooterSectionObject">
                <div class="jobObjectFooterSection">
                    <i class="fa fa-briefcase jobObjectFooterImage" aria-hidden="true"></i>
                    <div class="jobObjectFooterText">
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
                </div>
            </div>
            <div class="jobRowObjectFooterSectionObject">
                <div class="jobObjectFooterSection jobObjectFooterText">
                    <i class="fa fa-eur jobObjectFooterImage" aria-hidden="true"></i>
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
