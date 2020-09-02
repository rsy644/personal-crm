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

		<h2 style="clear: left; margin-bottom: 20px;">Edit a Company</h2>

		<form method="POST" role="form" enctype="multipart/form-data" action="{{route('companies.store') }}">
		@csrf
			<input type="hidden" name="update" class="update" id="update" value="Y">
			<input type="hidden" name="company_id" class="company_id" id="company_id" value="<?php echo $company->id; ?>">
			
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="name">Name</label>
					</div>
					<div class="col-sm-3">
						@if(isset($company->name))
							<input id="company" name="company" class="crm-input company" value="{{ $company->name }}">
						@else
							<input id="company" name="company" class="crm-input company">
						@endif

						@if(isset($company->contact_id))
							<input type="hidden" id="contact" name="contact" class="crm-input contact" value="{{ $company->contact_id }}">
						@endif
						
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="town">Town</label>
					</div>
					<div class="col-sm-3">
						@if(isset($company->town))
							<input id="company-town" name="company-town" class="crm-input company-town" value="{{ $company->town }}">
						@else
							<input id="company-town" name="company-town" class="crm-input company-town" value="">
						@endif			
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="postcode">Postcode</label>
					</div>
					<div class="col-sm-3">
						@if(isset($company->postcode) && $company->postcode != null)
							<input id="company-postcode" name="company-postcode" class="crm-input company-postcode" value="{{ $company->postcode }}">
						@else
							<input id="company-postcode" name="company-postcode" class="crm-input company-postcode" value="">
						@endif
					</div>
				</div>
			</div>
			<br/>
			<br/>
			<div class="form-input">
				<div class="row">
					<div class="col-sm-1">
						<label for="type">Type</label>
					</div>
					<div class="col-sm-3">
						@if(isset($company->type) && $company->type != null)
							<input id="company-type" name="company-type" class="crm-input company-type" value="{{ $company->type }}">
						@else
							<input id="company-type" name="company-type" class="crm-input company-type" value="">
						@endif
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
				 save_values_to_session();
			});
		});
	</script>
@endsection