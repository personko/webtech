@extends('_layouts.admin')

@section('content')
    <div class="row mb-3">
        <div class="col-lg-12">
            <div class="float-left">
                <h2>Uloha 2 - Rozdelenie bodov</h2>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger">
            <p>{{ $message }}</p>
        </div>
    @endif
    {!! Form::open(array('route' => 'uloha2.index','method'=>'POST','enctype'=>'multipart/form-data')) !!}
    <div class="col-6">
        <div class="form-group">
            <strong>Predmet:</strong>
            <select class="form-control" name="subject_id" @if (isset($subjectId))value="{{$subjectId}}" @endif>
                @foreach($subjects as $subject)
                    <option onclick="" value="{{$subject->id}}">{{$subject->nazov . ' ' . $subject->skolsky_rok}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            {!! Form::submit('Show', ['class' => 'btn btn-info']) !!}
        </div>
    </div>
    @if ($adminAgreedFilled)
        <div class="alert alert-success">
            <p>{{ 'Admin agree with stident devided points.' }}</p>
        </div>
    @endif
    {!! Form::close() !!}
    @if (isset($teamData) && !empty($teamData))
        <div class="col-6">
            <div class="form-group">
                <strong>Group points: {{$teamData[0]->tim_points}}</strong>
            </div>
        </div>
        {!! Form::open(array('route' => 'uloha2.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
        {!! Form::hidden('subject_id', $subjectId) !!}
        <table class="table table-bordered table-striped">
            <tr>
                <th>Email</th>
                <th>Full name</th>
                <th>Points</th>
                <th>Statement</th>
            </tr>
            @foreach ($teamData as $row)
                <tr>
                    <td>{{ $row->email }}</td>
                    <td>{{ $row->student_name }}</td>
                    @if ($pointsSet)
                        <td>{{ $row->student_points}}</td>
                    @else
                        <td> {!! Form::number($row->id, $value = '' , ['min' => '0' ,'class' => 'form-control', 'size' => 30 ,'required']) !!}</td>
                    @endif

                    <td>{{isset($row->student_confirm) ? ($row->student_confirm ? 'Agree' : 'Disagree') : ''}}
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="col-6">
            <div class="form-group">
                @if (!$pointsSet)
                    {!! Form::submit('Store', ['class' => 'btn btn-danger']) !!}
                @elseif (!$studentAgreeFilled)
                    {!! Form::submit('Accept', ['class' => 'btn btn-danger', 'name' => 'accept']) !!}
                    {!! Form::submit('Decline', ['class' => 'btn btn-danger', 'name' => 'decline']) !!}

                @endif
            </div>
        </div>
            {!! Form::close() !!}
    @endif
@endsection