<div class="col-lg-6">

    <div class="profilepic">
        @if ($contact->image_path != null)
            <img class="profilepicsize" src="../{{ $contact->image_path }}" />
        @else
            <img class="profilepicsize" src="../images/default_avatar.jpg" />
        @endif
    </div>
    <h1>{{ $contact->name }}
        @if(Entrust::can('contact-update'))
            <a href="{{ route('members.edit',$contact->id) }}" class="btn btn-secondary btn-sm">Edit</a>
        @endif
    </h1>
    <p><span class="glyphicon glyphicon-briefcase" aria-hidden="true"></span>
        {{ $contact->company_name }}</p>
    <!--MAIL-->
    <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
        <a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
    <!--Primary Phone-->
    <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
        <a href="tel:{{ $contact->work_number }}">{{ $contact->primary_number }}</a></p>

    <!--Secondary Phone-->
    @if ($contact->secondary_number != null)
    <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
        <a href="tel:{{ $contact->personal_number }}">{{ $contact->secondary_number }}</a></p>
    @endif

    <!--Address-->
    <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
        {{ $contact->address }} {{ $contact->city }} {{ $contact->state }} {{ $contact->zipcode }}  </p>

    <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
        {{ $contact->address }} {{ $contact->city }} {{ $contact->state }} {{ $contact->zipcode }}  </p>
</div>