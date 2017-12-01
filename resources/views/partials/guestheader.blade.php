<div class="col-md-8">

    <div class="profilepic">
        @if ($guest->image_path != null)
            <img class="profilepicsize" src="../{{ $contact->image_path }}" />
        @else
            <img class="profilepicsize" src="../images/default_avatar.jpg" />
        @endif
    </div>

    <h1 class="moveup">{{$guest->name}}
        @if(Entrust::can('contact-update'))
            <a href="{{ route('guests.edit',$guest->id) }}" class="btn btn-secondary btn-sm">Edit</a>
        @endif
    </h1>

    <!--Client info leftside-->
    <div class="contactleft">
        @if($guest->company_name != "")
                <!--Company-->
        <p><span class="glyphicon glyphicon-star" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Company') }}" data-placement="left"> </span> {{$guest->company_name}}</p>
        @endif

        @if($guest->email != "")
                <!--MAIL-->
        <p><span class="glyphicon glyphicon-envelope" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('mail') }}" data-placement="left"> </span>
            <a href="mailto:{{$guest->email}}" data-toggle="tooltip" data-placement="left">{{$guest->email}}</a></p>
        @endif
        @if($guest->primary_number != "")
                <!--Work Phone-->
        <p><span class="glyphicon glyphicon-headphones" aria-hidden="true" data-toggle="tooltip"
                 title=" {{ __('Primary number') }} " data-placement="left"> </span>
            <a href="tel:{{$guest->work_number}}">{{$guest->primary_number}}</a></p>
        @endif
        @if($guest->address || $guest->zipcode || $guest->city != "")
                <!--Address-->
        <p><span class="glyphicon glyphicon-home" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Full address') }}" data-placement="left"> </span> {{$guest->address}}
             {{$guest->city}} {{$guest->state}} {{$guest->zipcode}}
        </p>
        @endif
    </div>

    <!--Client info leftside END-->
    <!--Client info rightside-->
    <div class="contactright">
        @if($guest->industry != "")
                <!--Industry-->
        <p><span class="glyphicon glyphicon-briefcase" aria-hidden="true" data-toggle="tooltip"
                 title="{{ __('Industry') }}"data-placement="left"> </span> {{$guest->industry}}</p>
        @endif
    </div>
</div>

<!--Client info rightside END-->
