@extends('_layouts.admin')


@section('content')
<div class="row mb-5">
    <div class="col-lg-12">
        <div class="float-left">
            <h2>Uloha 1 - Management bodov</h2>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif


@foreach ($subjects as $points)
<div class="row">
    <div class="col">
        <div class="float-left">
            <h3>{{ $points->nazov }}</h3>
        </div>
        <div class="float-right">
            <p>
                {{ $points->skolsky_rok }} - {{ $points->semester == 1 ? 'Zimný semester' : 'Letný semester' }}
                <br/>
                Nahral/a: {{ $points->createdBy }}
            </p>
        </div>
    </div>
</div>

<hr class="mt-0 mb-4">

<table class="table table-bordered mb-5" style="font-size: 10px">
    <thead class="thead-dark">
        <tr>
            @foreach ($points->columns as $columnName)
            <th class="align-middle">{{ $columnName }}</th>
            @endforeach
        </tr>
    </thead>

    <tbody>
        <tr>
            @foreach ($points->points as $point)
            <td class="align-middle">{{ $point }}</td>
            @endforeach
        </tr>
    </tbody>
</table>
@endforeach

@endsection