@extends('navbar')
@section('reference')
    <div class="pageHeading">
        <h1 class="heading">Referencie</h1>
    </div>
    <div class="container pageContent">
        <div class="pageSubHeading">
            <h2 class="heading">Naša práca má zmysel, ak sú klienti spokojní</h2>
        </div>
        <div>
            @foreach ($references as $reference)
                <div class="row referenceRow">
                    <div class="col col-12 col-sm-12 col-md-4 col-lg-4">
                        <div class="referenceRowLeft">
                            <img src="{{ $reference->img_path }}" alt="{{ $reference->name }}" class="img_set">
                            <div class="heading">{{ $reference->name }}</div>
                            <div>{{ $reference->company }}</div>
                        </div>
                    </div>
                    <div class="col col-12 col-sm-12 col-md-8 col-lg-8">
                        <div class="referenceRowRight">
                            <?php echo htmlspecialchars_decode(stripslashes($reference->description)); ?>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@section('referenceTags')
    <meta name="description"
        content="Poskytujeme softvér a služby pre takmer 100 spoločností s licenciou na poskytovanie finančných služieb. Naša práca ma zmysel, ak sú klienti spokojní.">
    <meta name="keywords"
        content="referencie, Positive, softvérová spoločnosť Positive, povedali o nás, softvér, softvér a služby pre finančný trh, váš partner pre digitálnu transformáciu">
    <meta name="author" content="Positive s.r.o. © 2022">
@endsection

@section('referenceFbTags')
    <meta property="og:title" content="Referencie">
    <meta property="og:description"
        content="Poskytujeme softvér a služby pre takmer 100 spoločností s licenciou na poskytovanie finančných služieb. Naša práca ma zmysel, ak sú klienti spokojní.">
    <meta property="og:image" content="https://positive.sk//storage/settings/December2020/SBPaFn4ohfCM88LHeI6E.png">
    <meta property="og:url" content="http://joby.positive.sk/referencie">
    <meta property="og:type" content="website">
@endsection
