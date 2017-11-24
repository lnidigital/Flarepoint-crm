@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="meetings-table">
        <thead>
        <tr>
            <th>{{ __('Date') }}</th>
            <th>{{ __('Notes') }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>

@stop

@push('scripts')
<script>
    $(function () {
        $('#meetings-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: '{!! route('meetings.data') !!}',
            columns: [

                {data: 'namelink', name: 'meeting_date'},
                {data: 'meeting_notes', name: 'meeting_notes'},
                @if(Entrust::can('meetings-update'))   
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endif
                @if(Entrust::can('meetings-delete'))   
                { data: 'delete', name: 'delete', orderable: false, searchable: false},
                @endif

            ]
        });
    });
</script>
@endpush
