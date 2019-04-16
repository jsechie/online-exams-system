
 @if(count($errors)>0)	
	@foreach($errors->all() as $error)
		<div class="alert alert-error alert-block col-sm-12 col-md-11">
    		<button type="button" class="close" data-dismiss="alert">x</button>
    		<strong>{{$error}}</strong>
    	</div>
	@endforeach
@endif