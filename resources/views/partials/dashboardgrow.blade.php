<br/><br/>
<div class="col-sm-6">

    <div class="box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title"
            >
                {{ __('Referrals each month') }}
            </h4>
            <div class="box-tools pull-right">
                <button type="button" id="collapse1" class="btn btn-box-tool" data-toggle="collapse"
                        data-target="#collapseOne"><i id="toggler1" class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div id="collapseOne" class="panel-collapse">
            <div class="box-body">
                <div>
                    <graphline class="chart" :labels="{{json_encode($createdTaskEachMonths)}}"
                               :values="{{json_encode($taskCreated)}}"
                               :valuesextra="{{json_encode($taskCompleted)}}"></graphline>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title"
            >
               {{ __('Guests each month') }}
            </h4>
            <div class="box-tools pull-right">
                <button type="button" id="collapse2" class="btn btn-box-tool" data-toggle="collapse"
                        data-target="#collapseTwo"><i id="toggler2" class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div id="collapseTwo" class="panel-collapse">
            <div class="box-body">
                <div>
                    <graphline class="chart" :labels="{{json_encode($createdLeadEachMonths)}}"
                               :values="{{json_encode($leadCreated)}}"
                               :valuesextra="{{json_encode($leadsCompleted)}}"></graphline>

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title"
            >
                {{ __('1-to-1s each month') }}
            </h4>
            <div class="box-tools pull-right">
                <button type="button" id="collapse1" class="btn btn-box-tool" data-toggle="collapse"
                        data-target="#collapseOne"><i id="toggler1" class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div id="collapseOne" class="panel-collapse">
            <div class="box-body">
                <div>
                    <graphline class="chart" :labels="{{json_encode($createdTaskEachMonths)}}"
                               :values="{{json_encode($taskCreated)}}"
                               :valuesextra="{{json_encode($taskCompleted)}}"></graphline>
                </div>
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h4 class="box-title"
            >
               {{ __('Revenue each month') }}
            </h4>
            <div class="box-tools pull-right">
                <button type="button" id="collapse2" class="btn btn-box-tool" data-toggle="collapse"
                        data-target="#collapseTwo"><i id="toggler2" class="fa fa-minus"></i>
                </button>
            </div>
        </div>
        <div id="collapseTwo" class="panel-collapse">
            <div class="box-body">
                <div>
                    <graphline class="chart" :labels="{{json_encode($createdLeadEachMonths)}}"
                               :values="{{json_encode($leadCreated)}}"
                               :valuesextra="{{json_encode($leadsCompleted)}}"></graphline>

                </div>
            </div>
        </div>
    </div>
    
    


</div>
</div>


<!-- Info boxes -->
<div class="row movedown">

    <div class="col-sm-12">

        <div class="box box-primary">
            <div class="box-header with-border">
                <h4 class="box-title"
                >
                    {{ __('Members') }}
                </h4>
                <div class="box-tools pull-right">

                </div>
            </div>
            <div id="collapseOne" class="panel-collapse">

                @foreach($members as $member)
                    <div class="col-lg-1">
                        <a href="{{route('members.show', $member->id)}}">
                            <img class="small-profile-picture" data-toggle="tooltip" title="{{$member->name}}"
                                 data-placement="left"
                                 @if($member->image_path != "")
                                 src="images/{{$companyname}}/{{$member->image_path}}"
                                 @else
                                 src="images/default_avatar.jpg"
                                    @endif />
                        </a>

                    </div>

                @endforeach

            </div>
        </div>
    </div>
</div>
<!-- /.info-box -->
    
