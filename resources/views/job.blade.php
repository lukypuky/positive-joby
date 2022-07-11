@extends('navbar')
@section('job')
    <div class="container" style="text-align: center; width: 55%;">
        <div style="margin-top: 60px;">
            <div>
                {{-- image missing --}}
            </div>
            <div>
                <a href="{{ route('getIndex') }}" style="direction: none;"><i class="fa fa-arrow-left" aria-hidden="true"></i>
                    Späť na ponuku
                    jobov</a>
            </div>
            <div style="margin-bottom: 30px;">
                <h1>{{ $job->position_name }}</h1>
            </div>
            <div>
            </div>
        </div>
    </div>
@endsection
