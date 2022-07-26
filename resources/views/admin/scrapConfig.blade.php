@extends('admin.layout')


@section('subcontent')
<style>

</style>

	<div>
		<form id="send-form">
			<div class="fdms-inputs" style="">
				<div class="form-group">
					<label class="control-label">Select Product Type
					</label>
					<select class="form-control" name="product_type" id="product_type">
						<option value="product type 1">Product Type 1</option>
						<option value="product type 2">Product Type 2</option>
						<option value="product type 3">Product Type 3</option>
					</select>
				</div>
				
				<div class="form-group">
					<label class="control-label">Select day of Scrap
					</label>
					<select class="form-control" name="day" id="day">
						<?php
							for ($i = 7; $i < 40; $i++) {
								echo '<option value="'.$i.'">'.$i.'</option>';
							}
						?>
					</select>
				</div>
			</div>
			<div style="text-align:right; margin-top:50px;">
				<a class="fdms-btn confirm-btn" href="#">Confirm</a>
			</div>
		</form>	
	</div>

<script>

$(document).ready(function() {

	$('body').on('click', '.confirm-btn', function(e) {
		
		e.preventDefault();
		var data = {
			_token: '{{csrf_token()}}',
			product_type: $('#product_type').val(),
			day: $('#day').val()
		};
		
		$.post({
			url: "{{ url('/admin/scarp-config-update') }}",
			data: data,
			dataType: 'json',
			success: function (e) {
				if (e.success == true) {
					toastr.success(e.message);
				}
				else {
					toastr.error(e.error_message);
				}
			},
			error: function (e) {
				toastr.error('Error occured. Please try again or contact your service provider!');
			}
			
		});
		
	});
	
});

</script>
@endsection