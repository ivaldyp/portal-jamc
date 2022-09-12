@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  
    <h5><i class="icon fas fa-check"></i> Alert!</h5>
    <strong>{{ $message }}</strong>
</div>
@endif
  
@if ($message = Session::get('error'))
<div class="alert alert-error alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  
    <strong>{{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  
    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
    <strong>{{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('info'))
<div class="alert alert-info alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  
    <h5><i class="icon fas fa-info"></i> Alert!</h5>
    <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('danger'))
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>  
    <h5><i class="icon fas fa-ban"></i> Alert!</h5>
    <strong>{{ $message }}</strong>
</div>
@endif