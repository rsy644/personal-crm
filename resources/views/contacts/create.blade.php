@extends('layouts.main')
@section('content')


	<!--form for entering and adding new clients -->
	@php session_start();

	 @endphp
	<div class="container add-entry">
		<a class="back-link" href="{{ route('entries.create') }}">< Back</a>

		<h2 style="clear: left; margin-bottom: 20px;">Add a Contact</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('contacts.store') }}">
		@csrf

			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="name">Name</label>
					</div>
					<div class="col-sm-3">
						@if(isset($_SESSION['contact']) && $_SESSION['contact'] != null)
							<input id="contact" name="contact" class="crm-input contact" value="{{ $_SESSION['contact'] }}">
						@else
							<input id="contact" name="contact" class="crm-input contact" value="">
						@endif
						
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="telephone">Telephone No.</label>
					</div>
					<div class="col-sm-3">
						@if(isset($_SESSION['telephone']) && $_SESSION['telephone'] != null)
							<input id="telephone" name="telephone" class="crm-input telephone" value="{{ $_SESSION['telephone'] }}">
						@else
							<input id="telephone" name="telephone" class="crm-input telephone" value="">
						@endif
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="agency">Agency:</label>
					</div>
					<div class="col-sm-2">
						
						
							@if(isset($_SESSION['agency']) && $_SESSION['agency'] != null)
								<p id="agency" name="agency" class="crm-input agency">{{ $_SESSION['agency'] }}</p>
								<input type="hidden" name="agency_name" class="agency_name" value="{{ $_SESSION['agency'] }}">
							@elseif(isset($agency) && $agency->name != "")
								<p id="agency" name="agency" class="crm-input agency">{{ $agency->name }}</p>
							
								<input type="hidden" name="agency_name" class="agency_name" value="{{ $agency->name }}">
								<input type="hidden" name="agency_id" class="agency_id" value="{{ $agency->id }}">

							@endif

					</div>
					<div class="col-sm-3">
						
						<a class="btn btn-success entry-input" href="{{ route('agencies.create') }}" style="margin-top: -8px; color: #ffffff;" name="agency" class="agency" value="Add Agency">Add Agency</a>
					</div>
				</div>
			</div>
			<br/>
			<br/>
			
			<input type="submit" class="btn btn-success submit" value="Add">

		</form>
			
	</div>
	<script src="{{ asset('js/scripts.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.entry-input').on('click', function() {
				 save_values_to_contact_session();
			});

			$('.submit').on('click', function() {
				 save_values_to_session();
			});
		});


	</script>

@endsection