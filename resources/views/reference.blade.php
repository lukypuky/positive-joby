@extends('navbar')
@section('reference')
    <div style="text-align: center; background-color: #f5f4f2; padding: 30px;">
        <h1>Referencie</h1>
    </div>
    <div class="container pageContent">
        <div class="pageSubHeading">
            <h2>Naša práca má zmysel, ak sú klienti spokojní</h2>
        </div>
        <div>
            @foreach ($references as $reference)
                <div class="row referenceRow">
                    <div class="col col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="referenceRowLeft">
                            <img src="{{ $reference->img_path }}" alt="" class="img_set">
                            <div><strong>{{ $reference->name }}</strong></div>
                            <div>{{ $reference->company }}</div>
                        </div>
                    </div>
                    <div class="col col-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="referenceRowRight">{{ $reference->description }}</div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
