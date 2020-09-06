@extends('layouts.main')
@section('content')


	<!--form for entering and adding new clients -->
	@php 
	if(!isset($_SESSION)){
		session_start();
	}
	@endphp

	<div class="container add-entry">
		<a class="back-link" href="{{ route('entries.edit', $entry_id) }}">< Back</a>

		<h2 style="clear: left; margin-bottom: 20px;">Edit a Stage</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('stages.store') }}">
		@csrf
			<input type="hidden" name="update" class="update" id="update" value="Y">
			<input type="hidden" name="stage_id" class="stage_id" id="stage_id" value="<?php echo $stage->id; ?>">
			<input type="hidden" name="contact" class="contact" id="contact" value="<?php echo $contact_id; ?>">
			<input type="hidden" name="company" class="company" id="company" value="<?php echo $company_id; ?>">
			<input type="hidden" name="entry_id" class="entry_id" id="entry_id" value="<?php echo $entry_id; ?>">
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="name">Description</label>
					</div>
					<div class="col-sm-3">
						@if(isset($stage->description))
							<select id="stage" name="stage" class="crm-input stage">
								@foreach($stages as $single_stage)								
									<option value="{{ $single_stage }}" <?php if( $single_stage == $stage->description ): ?> selected="selected"<?php endif; ?>>{{ $single_stage }}</option>								
								@endforeach
							</select>
						@else
							<select id="stage" name="stage" class="crm-input stage">
								<option value="#">-- Please select a stage --</option>
								<option value="#">New Submission</option>
								<option value="#">In Review</option>
								<option value="#">First Interview</option>
								<option value="#">Second Interview</option>
								<option value="#">Background Check</option>
							</select>
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
						@if(isset($stage->feedback))
							<textarea id="feedback" name="feedback" class="crm-input feedback" rows="15" cols="39">{{ $stage->feedback }}</textarea>
						@else
							<textarea id="feedback" name="feedback" class="crm-input feedback" rows="15" cols="39"></textarea>
						@endif
					</div>

						@if(isset($stage->role_id))
							<input type="hidden" id="role" name="role" class="crm-input role" value="{{ $stage->role_id }}">
						@endif
						
					</div>
				</div>

				<input type="submit" class="btn btn-success stages-submit submit" value="Update">
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