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
        @include('partials.meetingheader')
    </div>
    <div class="col-lg-12">
            <strong>Attended Members</strong>
            <ul>
                @foreach ($attendedMembers as $attendedMember)
                    <li>{{$attendedMember->name}}</li>
                @endforeach
            </ul>
            <a href="{{ url('/attendance/' . $meeting->id . '/edit') }}" class="btn btn-primary">Update Attendance</a>
    </div>
    <div class="col-lg-12">
            <strong>Guests</strong>
            <ul>
                @foreach ($attendedGuests as $attendedGuest)
                    <li>{{$attendedGuest->name}}</li>
                @endforeach
            </ul>
            <a href="{{ url('/guests/create') }}" class="btn btn-primary">Add Guest</a>
    </div>
    
@stop
