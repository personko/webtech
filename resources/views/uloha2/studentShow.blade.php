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
            <a class="btn btn-info" href="{{ route('uloha2.index', ['id' => $subject->id]) }}">Show</a>
        </div>
    </div>
    @if (isset($teamData) && !empty($teamData))
        <div class="col-6">
            <div class="form-group">
                <strong>Group points: {{$teamData[0]->tim_points}}</strong>
            </div>
        </div>
        {!! Form::open(array('route' => 'uloha2.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
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

                    <td>{{isset($row->user_agreed) ? ($row->user_agreed ? 'Agree' : 'Disagree') : ''}}
                    </td>
                </tr>
            @endforeach
        </table>
        <div class="col-6">
            <div class="form-group">
                {!! Form::submit('Store', ['class' => 'btn btn-danger']) !!}
            </div>
        </div>
        {!! Form::close() !!}
    @endif


@endsection