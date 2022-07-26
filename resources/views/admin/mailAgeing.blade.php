@extends('admin.layout')


@section('subcontent')
<style>

</style>

	<div>
		<form id="send-form">
			<div class="fdms-inputs" style="">
				
				<div class="form-group">
					<label class="control-label">Select Email Sending Day (Last date of collection)
					</label>
					<select class="form-control" name="mail_aging" id="mail_aging">
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
			//product_type: $('#product_type').val(),
			mail_aging: $('#mail_aging').val()
		};
		
		$.post({
			url: "{{ url('/admin/mail-ageing-update') }}",
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
