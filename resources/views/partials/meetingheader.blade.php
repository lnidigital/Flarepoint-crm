<div class="col-md-6">

    <h1 class="moveup">{{ Helper::formatDate($meeting->meeting_date, ('F d, Y'))}}</h1>

        @if($meeting->meeting_notes != "")
                <!--MAIL-->
        <p>{{$meeting->meeting_notes}}</p>
        @endif
        
    
    </div>

    
</div>
