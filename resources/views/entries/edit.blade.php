@extends('layouts.main')
@section('content')

	<!--form for entering and adding new clients -->

	<div class="container add-entry">

		<a class="back-link" href="{{ route('entries.index') }}">< Back</a>

		<h2 style="clear: left; margin-bottom: 20px;">Edit an Entry</h2>		

		<form method="Post" role="form" enctype="multipart/form-data" action="{{route('entries.store') }}">
		@csrf
			<input type="hidden" name="update" class="update" id="update" value="Y">
			<input type="hidden" name="entry_id" class="entry_id" id="entry_id" value="<?php echo $entry->entry_id; ?>">
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="status">Status</label>
					</div>
					<div class="col-sm-3">
						@if(isset($entry->status) && $entry->status != null)
							<select id="status" name="status" class="status" value="">
								@foreach($statuses as $status)
									<option value="{{ $status }}" <?php if( $status == $entry->status ): ?> selected="selected"<?php endif; ?>>{{ $status }}</option>
								@endforeach
							</select>
						@else
							<select id="status" name="status" class="status" value="">
								@foreach($statuses as $status)
									<option value="{{ $status }}">{{ $status }}</option>
								@endforeach
							</select>
						@endif
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="warth">Warmth</label>
					</div>
					<div class="col-sm-3">
						@if(isset($entry->warmth) && $entry->warmth != null)
							<select id="warmth" name="warmth" class="warmth" value="">
								@foreach($thermos as $thermo)
									<option value="{{ $thermo }}" <?php if( $thermo == $entry->warmth ): ?> selected="selected"<?php endif; ?>>{{ $thermo }}</option>
								@endforeach
							</select>
						@else
							<select id="warmth" name="warmth" class="warmth" value="">
								@foreach($thermos as $thermo)
									<option value="{{ $thermo }}">{{ $thermo }}</option>
								@endforeach
							</select>
						@endif
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="contact">Contact:</label>
					</div>
					<div class="col-sm-3">
						
						@if(isset($entry->contact_name) && $entry->contact_name != null)
							<p>{{ $entry->contact_name }}
							</p>
							<input type="hidden" name="contact" class="contact" value="{{ $entry->contact_name }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-success entry-input contact" href="{{ route('contacts.edit', [$entry->contact_name, $entry->entry_id]) }}" style="margin-top: -8px; color: #ffffff;" name="contact" id="contact" value="Edit Contact">Edit</a>
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="company">Company:</label>
					</div>
					<div class="col-sm-3">
						
						@if(isset($entry->company_name) && $entry->company_name != null)
							<p>{{ $entry->company_name }}
							</p>
							<input type="hidden" name="company_name" class="company_name" value="{{ $entry->company_name }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-primary entry-input company" href="{{ route('companies.edit', [$entry->company_name, $entry->entry_id]) }}" style="margin-top: -8px; color: #ffffff;" name="company" value="Edit Company">Edit</a>
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="role">Role:</label>
					</div>
					<div class="col-sm-3">						
						@if(isset($entry->role_name) && $entry->role_name != null)
							<p>{{ $entry->role_name }}
							</p>
							<input type="hidden" name="role_name" class="entry-input role_name" value="{{ $entry->role_name }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-secondary entry-input role" href="{{ route('roles.edit', [$entry->role_name, $entry->entry_id, $entry->contact_id, $entry->company_id]) }}" style="margin-top: -8px; color: #ffffff;" name="role" value="Edit Role">Edit</a>
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="stage">Stage:</label>
					</div>
					<div class="col-sm-3">						
						@if(isset($entry->stage_description) && $entry->stage_description != null)
							<p>{{ $entry->stage_description }}
							</p>
							<input type="hidden" name="stage_name" class="entry-input stage_name" value="{{ $entry->stage_description }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-dark entry-input stage" href="{{ route('stages.edit', [$entry->stage_description, $entry->entry_id, $entry->contact_id, $entry->company_id]) }}" style="margin-top: -8px; color: #ffffff;" name="stage" value="Edit Stage">Edit</a>
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="action">Action:</label>
					</div>
					<div class="col-sm-3">						
						@if(isset($entry->description) && $entry->description != null)
							<p>{{ $entry->description }}
							</p>
							<input type="hidden" name="action_name" class="entry-input action_name" value="{{ $entry->description }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-danger entry-input action" href="{{ route('actions.edit', [$entry->contact_id, $entry->company_id, $entry->role_id, $entry->stage_id, $entry->description]) }}" style="margin-top: -8px; color: #ffffff;" name="action" value="Edit Action">Edit</a>
					</div>
				</div>
			</div>
			<input type="submit" class="btn btn-success submit" value="Update">
		</form>
	</div>

	<script src="{{ asset('js/scripts.js') }}"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){

			$('.delete_x').on('click', function() {
				 var name = $(this).data('model');
				 var type = $(this).parent().parent().prev().find('label').attr('for');
				 delete_values(type, name);
			});
		});
	</script>

	
@endsection