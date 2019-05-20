@extends('_layouts.admin')


@section('content')
<div class="row mb-3">
    <div class="col-lg-12">
        <div class="float-left">
            <h2>Uloha 1 - Management bodov</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-success" href="{{ route('uloha1.create') }}"> Pridať hodnotenia</a>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered table-striped">
    <tr>
        <th>Meno predmetu</th>
        <th>Školský rok</th>
        <th>Semester</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($subjects as $key => $subject)
    <tr>
        <td>{{ $subject->nazov }}</td>
        <td>{{ $subject->skolsky_rok }}</td>
        <td>{{ $subject->semester == 1 ? 'Zimný semester' : 'Letný semester' }}</td>
        <td>
            <a class="btn btn-info" href="{{ route('uloha1.show', ['id' => $subject->id]) }}">Show</a>
            {!! Form::open(['method' => 'DELETE','route' => ['uloha1.destroy', $subject->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
            {!! Form::close() !!}
        </td>
    </tr>
    @endforeach
</table>

@endsection