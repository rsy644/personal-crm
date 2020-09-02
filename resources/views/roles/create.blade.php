@extends('layouts.main')
@section('content')


	<!--form for entering and adding new clients -->
	@php 
	if(!isset($_SESSION)){
		session_start();
	}
	@endphp
	<div class="container add-entry">
		<a class="back-link" href="{{ route('entries.create') }}">< Back</a>

		<h2 style="clear: left; margin-bottom: 20px;">Add a Role</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('roles.store') }}">
		@csrf

			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="name">Name</label>
					</div>
					<div class="col-sm-3">
						@if(isset($_SESSION['role']) && $_SESSION['role'] != null)
							<input id="role" name="role" class="crm-input role" value="{{ $_SESSION['role'] }}">
						@else
							<input id="role" name="role" class="crm-input role">
						@endif

						<input type="hidden" id="contact" name="contact" class="crm-input contact" value="{{ $contact->id }}">						
						<input type="hidden" id="company" name="company" class="crm-input company" value="{{ $company->id }}">
						
					</div>
				</div>
			</div>
			
			<input type="submit" class="btn btn-success submit" value="Add">

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