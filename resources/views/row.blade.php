@foreach ($jobs as $job)
    <div class="col-sm-12 col-md-12 col-lg-12">
        <div class="p-3 objectBorder roundedCorners jobObject">
            <a href="/joby/{{ $job->slug }}" class="jobObjectLink">
                <div class="jobObjectHead">
                    <div class="jobRowObjectHeading">
                        <div class="jobRowObjectHeadingImage">
                            <i class="fa fa-user-o jobImage fa-2x"></i>
                        </div>
                        <div class="jobRowObjectHeadingImageObject">
                            <h4 class="jobRowObjectHeadingText heading">{{ $job->position_name }}</h4>
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
                        <div class="jobObjectFooterSection">
                            <i class="fa fa-eur jobObjectFooterImage" aria-hidden="true"></i>
                            @foreach ($salaryTypes as $salaryType)
                                @if ($job->id_salary_type === $salaryType->id && $salaryType->id === 3)
                                    <div class="jobObjectFooterText">
                                        {{ $salaryType->name }} {{ $job->salary_from }} €
                                        @foreach ($salaryTexts as $salaryText)
                                            @if ($job->id_salary_text === $salaryText->id)
                                                {{ $salaryText->name }}
                                            @endif
                                        @endforeach
                                    </div>
                                @elseif($job->id_salary_type === $salaryType->id && $salaryType->id === 4)
                                    <div class="jobObjectFooterText">
                                        {{ $job->salary_from }} € - {{ $job->salary_to }} €
                                        @foreach ($salaryTexts as $salaryText)
                                            @if ($job->id_salary_text === $salaryText->id)
                                                {{ $salaryText->name }}
                                            @endif
                                        @endforeach
                                    </div>
                                @elseif($job->id_salary_type === $salaryType->id && $salaryType->id === 5)
                                    <div class="jobObjectFooterText">
                                        @foreach ($salaryTexts as $salaryText)
                                            @if ($job->id_salary_text === $salaryText->id)
                                                {{ $salaryText->name }}
                                            @endif
                                        @endforeach
                                    </div>
                                @elseif($job->id_salary_type === $salaryType->id && $salaryType->id === 6)
                                    <div class="jobObjectFooterText">
                                        {{ $job->salary_from }} €
                                        @foreach ($salaryTexts as $salaryText)
                                            @if ($job->id_salary_text === $salaryText->id)
                                                {{ $salaryText->name }}
                                            @endif
                                        @endforeach
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
@endforeach

<div id="jobsCount" style="display: none;">{{ $count }}</div>
<div id="actualPage" style="display: none;">{{ $page }}</div>
