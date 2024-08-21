<div class="clear-both"></div>
@if(!empty(session('success')))
<div class="alert alert-success alert-dismissable face in" role="alert">
    {{session('success')}}
</div>
@endif


@if(!empty(session('error')))
<div class="alert alert-danger alert-dismissable face in" role="alert">
    {{session('error')}}
</div>
@endif