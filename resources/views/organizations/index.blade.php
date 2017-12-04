@extends('layouts.master')
@section('heading')

@stop

@section('content')

    <table class="table table-hover " id="organizations-table">
        <thead>
        <tr>
            <th>{{ __('Name') }}</th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>
    
    <a href="{{ route('organizations.create')}}" class="btn btn-primary">{{ __('+ Add New') }}</a>

@stop

@push('scripts')
<script>
    $(function () {
        $('#organizations-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('organizations.userdata', ['id' => Auth::id()]) !!}',
            dom: 'Blfrtip',
            buttons: [
                'copyHtml5',
                'excelHtml5',
                'csvHtml5',
                'pdfHtml5'
            ],
            "bLengthChange": false,
             columnDefs: [
                { "width": "100%", "targets": 0 }
              ],
            columns: [

                {data: 'name', name: 'name'},
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
