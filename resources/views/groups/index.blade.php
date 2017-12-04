@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="groups-table">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Organization') }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>
    
    <a href="{{ route('groups.create')}}" class="btn btn-primary">{{ __('+ Add New') }}</a>
   
@stop

@push('scripts')
<script>
    $(function () {
        $('#groups-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('groups.data') !!}',
            dom: 'Blfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "bLengthChange": false,
            columns: [

                {data: 'name', name: 'name'},
                {data: 'organization', name: 'organization'},
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                { data: 'delete', name: 'delete', orderable: false, searchable: false}
                
            ]
        });
    });
</script>
@endpush
