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

<table class="table table-bordered table-striped" id="subjectData">
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

<script type="text/javascript" src="{!! asset('js/jspdf.min.js') !!}"></script>

@endsection