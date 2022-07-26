@extends('admin.layout')


@section('subcontent')
<style>

</style>

	<div>
		<form id="send-form">
			<div class="fdms-inputs" style="">
				<div class="form-group">
					<label class="control-label">Bin Number / Code
					</label>
					<input class="form-control" name="bin_no" id="bin_no" required>
				</div>
			
				<div class="form-group">
					<label class="control-label">Bin Capacity
					</label>
					<input class="form-control" name="capacity" id="capacity" required>
				</div>
			
				<div class="form-group">
					<label class="control-label">Select DOP
					</label>
					<select class="form-control" name="dop" id="dop">
						<option value="dop1">DOP 1</option>
						<option value="dop2">DOP 2</option>
						<option value="dop3">DOP 3</option>
					</select>
				</div>
			</div>
			<div style="text-align:right; margin-top:50px;">
				<a class="fdms-btn" href="#">Cancel</a> &nbsp;
				<a class="fdms-btn create-btn" href="#">Create</a>
			</div>
		</form>	
	</div>
	
	
	
<script>

$(document).ready(function() {

	$('body').on('click', '.create-btn', function(e) {
		
		e.preventDefault();
		var data = {
			_token: '{{csrf_token()}}',
			bin_no: $('#bin_no').val(),
			capacity: $('#capacity').val(),
			dop: $('#dop').val()
		};
		
		$.post({
			url: "{{ url('/admin/create-bin') }}",
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