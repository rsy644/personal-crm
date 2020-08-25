@extends('layouts.main')
@section('content')
	<!--form for entering and adding new clients -->

	<div class="container contact add-entry">

		<a class="back-link" href="{{ route('contacts.create') }}">< Back</a>

		<h2 style="clear: left; margin-bottom: 20px;">Add an Agency</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('agencies.store') }}">
		@csrf

			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="name">Name</label>
					</div>
					<div class="col-sm-3">
						@if(isset($_SESSION['agency']) && $_SESSION['agency'] != null)
							<input id="name" name="name" class="crm-input agency" value="{{ $_SESSION['agency'] }}">
						@else
							<input id="name" name="name" class="crm-input agency" value="">
						@endif
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

			$('.submit').on('click', function() {
				 save_values_to_agency_session();
			});
		});


	</script>


@endsection