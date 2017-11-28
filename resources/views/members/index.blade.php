@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="members-table">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th>{{ __('Company') }}</th>
            <th>{{ __('Mail') }}</th>
            <th>{{ __('Number') }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>
    
    @if(Entrust::can('contact-create'))
        <a href="{{ route('members.create')}}" class="btn btn-primary">{{ __('+ Add New') }}</a>
    @endif

@stop

@push('scripts')
<script>
    $(function () {
        $('#members-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('members.data') !!}',
            dom: 'Blfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "bLengthChange": false,
            columns: [

                {data: 'namelink', name: 'name'},
                {data: 'company_name', name: 'company_name'},
                {data: 'email', name: 'email'},
                {data: 'primary_number', name: 'primary_number'},
                @if(Entrust::can('contact-update'))   
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endif
                @if(Entrust::can('contact-delete'))   
                { data: 'delete', name: 'delete', orderable: false, searchable: false},
                @endif

            ]
        });
    });
</script>
@endpush
