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

		<h2 style="clear: left; margin-bottom: 20px;">Add an Action</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('actions.store') }}">
		@csrf

			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="action">Action</label>
					</div>
					<div class="col-sm-3">
						@if(isset($_SESSION['action']) && $_SESSION['action'] != null)
							<input id="action_description" name="action_description" class="crm-input action" value="{{ $_SESSION['action'] }}">
						@else
							<input id="action_description" name="action_description" class="crm-input action">
						@endif

						<input type="hidden" id="contact" name="contact" class="crm-input contact" value="{{ $contact->id }}">
						<input type="hidden" id="company" name="company" class="crm-input company" value="{{ $company->id }}">
						<input type="hidden" id="role" name="role" class="crm-input role" value="{{ $role->id }}">
						<input type="hidden" id="stage" name="stage" class="crm-input stage" value="{{ $stage->id }}">

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
				 save_values_to_session('entries');
			});
		});


	</script>
@endsection