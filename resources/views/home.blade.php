@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            @ucenik
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Moji predmeti</a>
                <a href="#" class="list-group-item list-group-item-action">Moje ocjene</a>
            </div>
            @enducenik

            @nastavnik
            <div class="list-group">
                <a href="#" class="list-group-item list-group-item-action">Moji razredi</a>
                <a href="#" class="list-group-item list-group-item-action">Moji predmeti</a>
                <a href="#" class="list-group-item list-group-item-action">Moji učenici</a>
            </div>
            @endnastavnik

            @administrator
            @include('layouts.menu')
            @endadministrator

        </div>
        <div class="col-md-9"></div>
    </div>
</div>
@endsection