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

		<h2 style="clear: left; margin-bottom: 20px;">Add a Stage</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('stages.store') }}">
		@csrf

			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="name">Description</label>
					</div>
					<div class="col-sm-3">
						@if(isset($_SESSION['stage']) && $_SESSION['stage'] != null)
							<input id="stage" name="stage" class="crm-input stage" value="{{ $_SESSION['stage'] }}">
						@else
							<input id="stage" name="stage" class="crm-input stage">
						@endif
					</div>
				</div>
				<br/>
				<br/>
				<div class="row">
					<div class="col-sm-1">
						<label for="feedback">Feedback</label>
					</div>
					<div class="col-sm-3">
						<textarea id="feedback" name="feedback" class="crm-input feedback" rows="15" cols="39"></textarea>
					</div>

						@if(isset($_SESSION['role']) && $_SESSION['role'] != null)
							<input type="hidden" id="role" name="role" class="crm-input role" value="{{ $_SESSION['role'] }}">
						@endif
						
					</div>
				</div>

				<input type="submit" class="btn btn-success stages-submit submit" value="Add">
			</div>

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