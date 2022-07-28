@foreach ($jobs as $job)
    <div class="col-sm-12 col-md-6 col-lg-6">
        <div class="p-3 objectBorder roundedCorners jobObject">
            <a href="/joby/{{ $job->slug }}" class="jobObjectLink">
                <div class="jobObjectHead">
                    <div class="jobTileObjectHeading">
                        <div class="jobTileObjectHeadingImage">
                            <i class="fa fa-user-o jobImage fa-2x"></i>
                        </div>
                        <div class="jobTileObjectHeadingImageObject">
                            <h4 class="jobTileObjectHeadingText heading">{{ $job->position_name }}</h4>
                        </div>
                    </div>
                </div>
                <div class="jobTileObjectFooter">
                    <div class="jobTileObjectFooterSectionObject">
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
                    <div class="jobTileObjectFooterSectionObject">
                        <div class="jobObjectFooterSection jobObjectFooterText">
                            <i class="fa fa-eur jobObjectFooterImage" aria-hidden="true"></i>
                            @foreach ($salaryTypes as $salaryType)
                                @if ($job->id_salary_type === $salaryType->id &&
                                    ($salaryType->id === 1 || $salaryType->id === 2 || $salaryType->id === 7 || $salaryType->id === 8))
                                    @if ($salaryType->text_after)
                                        <div>{{ $job->salary_from }} € {{ $salaryType->name }}
                                            {{ $salaryType->text_after }}</div>
                                    @else
                                        <div>{{ $job->salary_from }} € {{ $salaryType->name }} </div>
                                    @endif
                                @elseif($job->id_salary_type === $salaryType->id && ($salaryType->id === 3 || $salaryType->id === 9))
                                    @if ($salaryType->text_after)
                                        <div>{{ $salaryType->name }} {{ $job->salary_from }} €
                                            {{ $salaryType->text_after }}</div>
                                    @else
                                        <div>{{ $salaryType->name }} {{ $job->salary_from }} €</div>
                                    @endif
                                @elseif($job->id_salary_type === $salaryType->id && ($salaryType->id === 4 || $salaryType->id === 10))
                                    @if ($salaryType->text_after)
                                        <div>{{ $job->salary_from }} € - {{ $job->salary_to }} €
                                            {{ $salaryType->text_after }}</div>
                                    @else
                                        <div>{{ $job->salary_from }} € - {{ $job->salary_to }} €</div>
                                    @endif
                                @elseif($job->id_salary_type === $salaryType->id && $salaryType->id === 5)
                                    <div>{{ $salaryType->name }}</div>
                                @elseif($job->id_salary_type === $salaryType->id && ($salaryType->id === 6 || $salaryType->id === 11))
                                    @if ($salaryType->text_after)
                                        <div>{{ $job->salary_from }} € {{ $salaryType->text_after }}</div>
                                    @else
                                        <div>{{ $job->salary_from }} €</div>
                                    @endif
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
