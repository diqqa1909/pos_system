@if(!@empty(session('success')))
    <div role="alert" class="alert alert-success">
        {{session('success')}}
    </div>
@endif
@if(!@empty(session('error')))
    <div role="alert" class="alert alert-danger">
        {{session('error')}}
    </div>
@endif