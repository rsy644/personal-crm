@extends('layouts.main')
@section('content')
	<!--form for entering and adding new clients -->

	<div class="container contact add-entry">

		<a class="back-link" href="{{ route('contacts.edit', [$entry_id, $contact_id]) }}">< Back</a>

		<h2 style="clear: left; margin-bottom: 20px;">Edit an Agency</h2>

		<form method="PUT" role="form" enctype="multipart/form-data" action="{{route('agencies.update', [$agency->id, $contact_id, $entry_id]) }}">
		@csrf

			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="name">Name</label>
					</div>
					<div class="col-sm-3">
						
							<input id="name" name="name" class="crm-input agency" value="{{ $agency->name }}">
						
					</div>

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

			$('.submit').on('click', function() {
				 save_values_to_agency_session();
			});
		});


	</script>


@endsection