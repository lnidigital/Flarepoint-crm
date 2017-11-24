@extends('layouts.master')
@section('heading')
    <h1>Create Member</h1>
@stop

@section('content')
@push('scripts')
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip(); //Tooltip on icons top

            $('.popoverOption').each(function () {
                var $this = $(this);
                $this.popover({
                    trigger: 'hover',
                    placement: 'left',
                    container: $this,
                    html: true
                });
            });
        });
    </script>
@endpush

    <?php
    $data = Session::get('data');
    ?>

    {!! Form::open([
            'route' => 'members.store',
            'class' => 'ui-form'
            ]) !!}
    @include('members.form', ['submitButtonText' => __('Create New Member')])

    {!! Form::close() !!}


@stop
