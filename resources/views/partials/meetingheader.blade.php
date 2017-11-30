<div class="col-md-8">

    <h1 class="moveup">{{ Helper::formatDate($meeting->meeting_date, ('F d, Y'))}}</h1>
    @if($meeting->meeting_notes != "")
    	<p>{!! nl2br(e($meeting->meeting_notes)) !!}</p>
    @endif    
</div>
