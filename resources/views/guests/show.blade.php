@extends('layouts.master')
@section('heading')
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
                    html: true,
                    content: $this.find('#popover_content_wrapper').html()
                });
            });
        });
    </script>
@endpush
    <div class="row">
        @include('partials.guestheader')
    </div>
    <div class="row">
        <div class="col-md-8 currenttask">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#task">{{__('Referrals')}}</a></li>
                <li><a data-toggle="tab" href="#lead">{{__('1-on-1s')}}</a></li>

            </ul>
            <div class="tab-content">
                
            </div>
        </div>
    </div>
    <div class="col-md-4 currenttask">
               
    </div>
    </div>
    </div>
@stop
