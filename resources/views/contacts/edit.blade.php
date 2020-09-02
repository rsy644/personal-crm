@extends('layouts.main')
@section('content')


	<!--form for entering and adding new clients -->
	@php session_start();
	 @endphp
	<div class="container add-entry">
		<a class="back-link" href="{{ route('entries.edit', $entry_id) }}">< Back</a>

		<h2 style="clear: left; margin-bottom: 20px;">Edit a Contact</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('contacts.store') }}">
		@csrf
			<input type="hidden" name="update" class="update" id="update" value="Y">
			<input type="hidden" name="contact_id" class="contact_id" id="contact_id" value="<?php echo $contact->id; ?>">
			<input type="hidden" name="entry_id" class="entry_id" id="entry_id" value="<?php echo $entry_id; ?>">
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="name">Name</label>
					</div>
					<div class="col-sm-3">
						@if(isset($contact->name) && $contact->name != null)
							<input id="contact" name="contact" class="crm-input contact" value="{{ $contact->name }}">
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
						@if(isset($contact->telephone_number) && $contact->telephone_number != null)
							<input id="telephone" name="telephone" class="crm-input telephone" value="0{{ $contact->telephone_number }}">
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
					@if(isset($agency->name) && $agency->name != null)
						<div class="col-sm-1">
							<label for="agency">Agency:</label>
						</div>
						<div class="col-sm-2">							
							<p id="agency" name="agency" class="crm-input agency">{{ $agency->name }}</p>
							<input type="hidden" name="agency_name" class="agency_name" value="{{ $contact->agency_id }}">
						</div>
						<div class="col-sm-3">							
							<a class="btn btn-success entry-input" href="{{ route('agencies.edit', [$contact->agency_id, $contact->id, $entry_id]) }}" style="margin-top: -8px; color: #ffffff;" name="agency" class="agency" value="Edit Agency">Edit Agency</a>
						</div>
					@endif

				</div>
			</div>
			<br/>
			<br/>
			
			<input type="submit" class="btn btn-success submit" value="Update">

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