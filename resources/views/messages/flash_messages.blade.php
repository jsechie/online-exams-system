<br>
@if(Session::has('flash_message_error'))
	<div class="alert alert-error alert-block col-sm-12 col-md-11">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<strong>{!! session('flash_message_error') !!} </strong>
	</div>
@endif

@if(Session::has('flash_message_success'))
	<div class="alert alert-success alert-block col-sm-12 col-md-11">
		<button type="button" class="close" data-dismiss="alert">x</button>
		<strong>{!! session('flash_message_success') !!} </strong>
	</div>
@endif