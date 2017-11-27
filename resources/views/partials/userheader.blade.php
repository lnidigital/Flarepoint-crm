<div class="col-lg-6">

    <div class="profilepic"><img class="profilepicsize" src="../{{ $user->avatar }}" /></div>
    <h1>{{ $user->name }} 
            <a href="{{ route('users.edit',$user->id) }}" class="btn btn-secondary btn-sm">Edit</a>
    </h1>

    <!--MAIL-->
    <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p>
    <!--Work Phone-->
    <p><span class="glyphicon glyphicon-headphones" aria-hidden="true"></span>
        <a href="tel:{{ $user->work_number }}">{{ $user->work_number }}</a></p>

    <!--Personal Phone-->
    <p><span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
        <a href="tel:{{ $user->personal_number }}">{{ $user->personal_number }}</a></p>

    <!--Address-->
    <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span>
        {{ $user->address }}  </p>
</div>