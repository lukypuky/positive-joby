@extends('navbar')
@section('job')
    <div class="container" style="text-align: center; width: 55%;">
        <div style="margin-top: 60px;">
            <div>
                {{-- image missing --}}
            </div>
            <div style="text-align: left; margin-bottom: 30px;">
                <a href="{{ route('getIndex') }}"><i class="fa fa-arrow-left" aria-hidden="true"></i>Späť na ponuku jobov</a>
            </div>
            <div style="margin-bottom: 30px;">
                <h1>{{ $job->position_name }}</h1>
            </div>
            <div>
                <div class="flex2">
                    <div class="flex-items" style="align-items: center;">
                        <div class="jobObjectFooterImage"
                            style="    background-color: black;
                        color: #fff;
                        border-radius: 25px;
                        padding: 3px 20px;">
                            <i class="fa fa-briefcase jobObjectFooterImage" aria-hidden="true"></i>
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
                        <div
                            style="display: flex;     background-color: black;
                        color: #fff;
                        border-radius: 25px;
                        padding: 3px 20px;">
                            <i class="fa fa-eur jobObjectFooterImage" aria-hidden="true" style="align-self: center;"></i>
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
                    <div class="flex-items">
                        <button class="btn btn-primary orangeObject" style="border-radius: 25px; padding: 10px 20px;">MÁM
                            ZÁUJEM</button>
                    </div>
                </div>
            </div>
        </div>
        <div style="text-align: left;">
            <div style="margin: 30px 0px;">
                <div style="display: flex;">
                    <i class="fa fa-eur jobObjectFooterImage" aria-hidden="true" style="align-self: center;"></i>
                    <h2>Čo budeš robiť?</h2>
                </div>
                <div style="padding: 10px 20px;">
                    <div>
                        {{ $job->description }}
                    </div>
                </div>
            </div>
            <div style="margin: 30px 0px;">
                <div style="display: flex;">
                    <i class="fa fa-eur jobObjectFooterImage" aria-hidden="true" style="align-self: center;"></i>
                    <h2>Mzdové podmienky</h2>
                </div>
                <div style="padding: 10px 20px;">
                    <div>
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
            <div style="margin: 30px 0px;">
                <div style="display: flex;">
                    <i class="fa fa-eur jobObjectFooterImage" aria-hidden="true" style="align-self: center;"></i>
                    <h2>Čo od teba očakávame?</h2>
                </div>
                <div style="padding: 10px 20px;">
                    <div>
                        {{ $job->expectation }}
                    </div>
                </div>
            </div>
            <div style="margin: 30px 0px;">
                <div style="display: flex;">
                    <i class="fa fa-eur jobObjectFooterImage" aria-hidden="true" style="align-self: center;"></i>
                    <h2>Základné benefity</h2>
                </div>
                <div style="padding: 10px 20px;">
                    <div>
                        {{ $job->benefits }}
                    </div>
                </div>
            </div>
            <div style="margin: 30px 0px;">
                <div style="display: flex;">
                    <i class="fa fa-eur jobObjectFooterImage" aria-hidden="true" style="align-self: center;"></i>
                    <h2>Odoslať žiadosť</h2>
                </div>
                <div style="padding: 10px 20px;">
                    <div>
                        <div>
                            <div style="margin-bottom: 15px;">Máš záujem o toto miesto? Vyplň formulár a budeme ťa
                                kontaktovať.</div>
                            <form action="#" method="POST">
                                <div class="row" style="display: flex; justify-content: center;">
                                    <div class="col col-12 col-sm-12 col-md-4 col-lg-4">
                                        <div>
                                            <input type="text" class="form-control" id="nameSurname" name="nameSurname"
                                                placeholder="Meno a priezvisko"
                                                style="border-radius: 3px;margin-bottom: 15px;">
                                        </div>
                                        <div>
                                            <input type="text" class="form-control" id="phone" name="phone"
                                                placeholder="Telefón" style="border-radius: 3px;margin-bottom: 15px;">
                                        </div>
                                        <div>
                                            <input type="email" class="form-control" id="email" name="email"
                                                placeholder="Email" style="border-radius: 3px;margin-bottom: 15px;">
                                        </div>
                                    </div>
                                    <div class="col col-12 col-sm-12 col-md-8 col-lg-8">
                                        <div>
                                            <textarea class="form-control" placeholder="Prečo práve ty?" name="message"
                                                style="border-radius: 3px;
                                            height: 145px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div style="margin-bottom: 30px;">
                                    <button style="background: transparent;"><i
                                            class="fa fa-user-o jobObjectFooterImage"></i>Pridať
                                        prílohu</button>
                                </div>
                                <div>
                                    <div>
                                        <button class="btn btn-primary orangeObject"
                                            style="border-radius: 25px; padding: 10px 20px;">ODOSLAŤ ŽIADOSŤ</button>
                                    </div>
                                    <div>
                                        <input class="form-check-input checkboxMargin" type="checkbox"
                                            id="conditionsCheckBox">
                                        <label class="form-check-label" for="flexCheckDefault">Vyhlasujem, že som sa
                                            oboznámil s
                                            <a href="#">Podmienkami spracúvania a ochrany osobných údajov</a></label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
