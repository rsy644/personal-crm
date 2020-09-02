@extends('layouts.main')
@section('content')


	<!--form for entering and adding new clients -->
	@php 
	if(!isset($_SESSION)){
		session_start();
	}
	@endphp
	<div class="container add-entry">
		<a class="back-link" href="{{ route('entries.create', $entry_id) }}">< Back</a>

		<h2 style="clear: left; margin-bottom: 20px;">Edit a Role</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('roles.store') }}">
		@csrf
			<input type="hidden" name="update" class="update" id="update" value="Y">
			<input type="hidden" name="role_id" class="role_id" id="role_id" value="<?php echo $role->id; ?>">
			<input type="hidden" name="entry_id" class="entry_id" id="entry_id" value="<?php echo $entry_id; ?>">
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="name">Name</label>
					</div>
					<div class="col-sm-3">
						@if(isset($role->name))
							<input id="role" name="role" class="crm-input role" value="{{ $role->name }}">
						@else
							<input id="role" name="role" class="crm-input role">
						@endif

						@if(isset($role->company_id))
							<input type="hidden" id="company" name="company" class="crm-input company" value="{{ $role->company_id }}">
						@endif
						
					</div>
				</div>
			</div>
			
			<input type="submit" class="btn btn-success submit" value="Edit">

		</form>
			
	</div>
	<script src="{{ asset('js/scripts.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.submit').on('click', function() {
				 save_values_to_session();
			});
		});


	</script>
@endsection