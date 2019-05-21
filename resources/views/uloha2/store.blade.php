@extends('_layouts.admin')

@section('content')
    <div class="row mb-5">
        <div class="col">
            <div class="float-left">
                <h2>Uloha 1 - Management bodov</h2>
            </div>
            <div class="float-right">
                <a class="btn btn-secondary" href="{{ route('uloha2.index') }}"> Späť</a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
@endsection