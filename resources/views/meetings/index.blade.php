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

    @if(Entrust::can('meeting-create'))
      <a href="{{ route('meetings.create')}}" class="btn btn-primary">{{ __('+ Add New') }}</a>
    @endif

@stop

@push('scripts')
<script>
    $(function () {
        $('#meetings-table').DataTable({
            processing: true,
            serverSide: true,
            order: [[0, "desc"]],
            ajax: '{!! route('meetings.data') !!}',
            columns: [

                {data: 'namelink', name: 'meeting_date'},
                {data: 'meeting_notes_short', name: 'meeting_notes'},
                @if(Entrust::can('meeting-update'))   
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endif
                @if(Entrust::can('meeting-delete'))   
                { data: 'delete', name: 'delete', orderable: false, searchable: false},
                @endif

            ]
        });
    });
</script>
@endpush
