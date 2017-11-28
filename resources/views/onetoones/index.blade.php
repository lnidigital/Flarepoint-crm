@extends('layouts.master')
@section('heading')

@stop

@section('content')
    
    <table class="table table-hover " id="onetoones-table">
        <thead>
        <tr>
            <th>{{ __('From') }}</th>
            <th>{{ __('To') }}</th>
            <th>{{ __('Date') }}</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>
    
    @if(Entrust::can('onetoone-create'))
      <a href="{{ route('onetoones.create')}}" class="btn btn-primary">{{ __('+ Add New') }}</a>
    @endif
@stop

@push('scripts')
<script>
    $(function () {
        $('#onetoones-table').DataTable({
            processing: true,
            serverSide: true,

            ajax: '{!! route('onetoones.data') !!}',
            columns: [

                {data: 'first_contact_name', name: 'first_contact_id'},    
                {data: 'second_contact_name', name: 'second_contact_id'},
                {data: 'onetoone_date_formatted', name: 'onetoone_date'},
                @if(Entrust::can('onetoone-update'))   
                { data: 'edit', name: 'edit', orderable: false, searchable: false},
                @endif
                @if(Entrust::can('onetoone-delete'))   
                { data: 'delete', name: 'delete', orderable: false, searchable: false},
                @endif

            ]
        });
    });
</script>
@endpush
