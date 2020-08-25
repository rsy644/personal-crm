@extends('layouts.main')
@section('content')

	<!--form for entering and adding new clients -->

	<div class="container add-entry">


		<a class="back-link" href="{{ route('entries.index') }}">< Back</a>

		<h2 style="clear: left; margin-bottom: 20px;">Add an Entry</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('entries.store') }}">
		@csrf
		@php session_start();
			 if(isset($delete_contact) && $delete_contact != false){
	 			$_SESSION['contact'] = "";
	 			$_SESSION['telephone'] = "";
	 			$_SESSION['agency'] = "";
			 }
			 if(isset($delete_company) && $delete_company != false){
	 			$_SESSION['company'] = "";
	 			$_SESSION['company-town'] = "";
	 			$_SESSION['company-postcode'] = "";
	 			$_SESSION['company-type'] = "";
			 }
			 if(isset($delete_role) && $delete_role != false){
	 			$_SESSION['role'] = "";
			 }
			 if(isset($delete_stage) && $delete_stage != false){
	 			$_SESSION['stage'] = "";
			 }
		     if(isset($delete_action) && $delete_action != false){
	 			$_SESSION['action'] = "";
			 }
		 @endphp
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="status">Status</label>
					</div>
					<div class="col-sm-3">
						@if(isset($_SESSION['status']) && $_SESSION['status'] != null)
							<select id="status" name="status" class="status" value="">
								@foreach($statuses as $status)
									<option value="{{ $status }}" <?php if( $status == $_SESSION['status'] ): ?> selected="selected"<?php endif; ?>>{{ $status }}</option>
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
						@if(isset($_SESSION['warmth']) && $_SESSION['warmth'] != null)
							<select id="warmth" name="warmth" class="warmth" value="">
								@foreach($thermos as $thermo)
									<option value="{{ $thermo }}" <?php if( $thermo == $_SESSION['warmth'] ): ?> selected="selected"<?php endif; ?>>{{ $thermo }}</option>
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
						
						@if(isset($_SESSION['contact']) && $_SESSION['contact'] != null)
							<p>{{ $_SESSION['contact'] }}
							<span class="delete_x" data-toggle="modal" data-target="#delete_modal_<?php echo $_SESSION['contact'] ?>" data-model="<?php echo $_SESSION['contact'] ?>">x</span>
							</p>
							<input type="hidden" name="contact" class="contact" value="{{ $_SESSION['contact'] }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-success entry-input contact" style="margin-top: -8px; color: #ffffff;" name="contact" id="contact" value="Add Contact">Add</a>
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
						
						@if(isset($_SESSION['company']) && $_SESSION['company'] != null)
							<p>{{ $_SESSION['company'] }}
							<span class="delete_x" data-toggle="modal" data-target="#delete_modal_<?php echo $_SESSION['company']; ?>" data-model="<?php echo $_SESSION['company']; ?>">x</span>
							</p>
							<input type="hidden" name="company_name" class="company_name" value="{{ $_SESSION['company'] }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-primary entry-input company" style="margin-top: -8px; color: #ffffff;" name="company" value="Add Company">Add</a>
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
						@if(isset($_SESSION['role']) && $_SESSION['role'] != null)
							<p>{{ $_SESSION['role'] }}
							<span class="delete_x" data-toggle="modal" data-target="#delete_modal_<?php echo $_SESSION['role']; ?>" data-model="<?php echo $_SESSION['role']; ?>">x</span>
							</p>
							<input type="hidden" name="role_name" class="entry-input role_name" value="{{ $_SESSION['role'] }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-secondary entry-input role" style="margin-top: -8px; color: #ffffff;" name="role" value="Add Role">Add</a>
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
						@if(isset($_SESSION['stage']) && $_SESSION['stage'] != null)
							<p>{{ $_SESSION['stage'] }}
							<span class="delete_x" data-toggle="modal" data-target="#delete_modal_<?php echo $_SESSION['stage']; ?>" data-model="<?php echo $_SESSION['stage']; ?>">x</span>
							</p>
							<input type="hidden" name="stage_name" class="entry-input stage_name" value="{{ $_SESSION['stage'] }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-dark entry-input stage" style="margin-top: -8px; color: #ffffff;" name="stage" value="Add Stage">Add</a>
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
						@if(isset($_SESSION['action']) && $_SESSION['action'] != null)
							<p>{{ $_SESSION['action'] }}
							<span class="delete_x" data-toggle="modal" data-target="#delete_modal_<?php echo $_SESSION['action']; ?>" data-model="<?php echo $_SESSION['action']; ?>">x</span>
							</p>
							<input type="hidden" name="action_name" class="entry-input action_name" value="{{ $_SESSION['action'] }}">
						@endif
					</div>
					<div class="col-sm-3">
						<a class="btn btn-danger entry-input action" style="margin-top: -8px; color: #ffffff;" name="action" value="Add Action">Add</a>
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
			$('.entry-input').on('click', function() {
				 var name = $(this).attr('name');
				 save_values_to_session(name);
			});

			$('.delete_x').on('click', function() {
				 var name = $(this).data('model');
				 var type = $(this).parent().parent().prev().find('label').attr('for');
				 delete_values(type, name);
			});
		});
	</script>

	
@endsection