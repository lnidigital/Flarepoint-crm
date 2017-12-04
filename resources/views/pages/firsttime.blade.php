@extends('layouts.master')

@section('content')
@push('scripts')
   
@endpush
        
    <div>
    You don't belong to any groups or organizations.

    Would you like to create one?
</div>
    <a href="{{ route('organizations.create')}}" class="btn btn-primary">{{ __('+ Create new organization ') }}</a>
    
    <a href="{{ route('groups.create')}}" class="btn btn-primary">{{ __('+ Create new group') }}</a>
    

@endsection
