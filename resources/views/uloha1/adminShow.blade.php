@extends('_layouts.admin')


@section('content')
<div class="row mb-5">
    <div class="col">
        <div class="float-left">
            <h2>Uloha 1 - Management bodov</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-secondary" href="{{ route('uloha1.index') }}"> Späť</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif

<div id="subjectData">
    <div class="row">
        <div class="col">
            <div class="float-left">
                <h3>{{ $points->nazov }}</h3>
            </div>
            <div class="float-right">
                <p>{{ $points->skolsky_rok }} - {{ $points->semester == 1 ? 'Zimný semester' : 'Letný semester' }}</p>
            </div>
        </div>
    </div>

    <hr class="mt-0 mb-4">

    <table class="table table-bordered table-striped" style="font-size: 10px">
        <thead class="thead-dark">
            <tr>
                @foreach ($points->columns as $columnName)
                <th class="align-middle">{{ $columnName }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @foreach ($points->points as $pointRow)
            <tr>
                @foreach ($pointRow as $point)
                <td class="align-middle">{{ $point }}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col">
            <a class="btn btn-danger" href="#" onclick="pdfFromHTML('{{ preg_replace("/[^A-Za-z0-9]/", '', $points->nazov) }}')"> Stiahnúť PDF</a>
        </div>
    </div>
</div>

@endsection