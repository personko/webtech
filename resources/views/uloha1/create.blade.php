@extends('_layouts.admin')


@section('content')
<div class="row mb-3">
    <div class="col-lg-12">
        <div class="float-left">
            <h2>Pridať hodnotenia</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-secondary" href="{{ route('uloha1.index') }}"> Back</a>
        </div>
    </div>
</div>


@if (count($errors) > 0)
<div class="alert alert-danger">
    <strong>Whoops!</strong> There were some problems with your input.<br><br>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif


{!! Form::open(array('route' => 'uloha1.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
<div class="row">
    <div class="col-12">
        <div class="form-group">
            <strong>Meno predmetu:</strong>
            {!! Form::text('nazov', null, array('placeholder' => 'Meno predmetu','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <strong>Školský rok:</strong>
            {!!  Form::select('skolsky_rok', ['2017/2018' => '2017/2018', '2018/2019' => '2018/2019', '2019/2020' => '2019/2020', '2020/2021' => '2020/2021', '2020/2021' => '2020/2021'], '2019/2020', ['class' => 'form-control' ]) !!}
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <strong>Semester:</strong>
            {!!  Form::select('semester', ['1' => 'Zimný', '2' => 'Letný'], 1, ['class' => 'form-control' ]) !!}
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <strong>Súbor:</strong>
            <div class="custom-file">
                <input type="file" name="csv_import" class="custom-file-input" id="customFile">
                <label class="custom-file-label" for="customFile">Choose file</label>
            </div>
        </div>
    </div>

    <div class="col-6">
        <div class="form-group">
            <strong>Oddelovač:</strong>
            {!! Form::text('oddelovac', null, array('placeholder' => 'Použitý oddelovač v CSV','class' => 'form-control')) !!}
        </div>
    </div>

    <div class="col-12">
        <button type="submit" class="btn btn-primary">Nahrat</button>
    </div>
</div>
{!! Form::close() !!}


@endsection