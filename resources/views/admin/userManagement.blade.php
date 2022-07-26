@extends('admin.layout')


@section('subcontent')
<style>

</style>

<div>
	<h5>Add User</h5>
	<form id="send-form">
		<div class="fdms-inputs">
			<div class="form-group">
				<label class="control-label">Username
				</label>
				<input class="form-control" name="username" required>
			</div>
		
			<div class="form-group">
				<label class="control-label">Email Address
				</label>
				<input class="form-control" name="email" required>
			</div>
		
			<div class="form-group">
				<label class="control-label">Phone number
				</label>
				<input class="form-control" name="mobile" required>
			</div>
		
			<div class="form-group">
				<label class="control-label">Select user type
				</label>
				<select class="form-control" name="type" required>
					@if(Auth::user()->type == 'superadmin')<option value="admin">Admin</option>@endif
					<option value="huboperator">Hub Operator</option>
					<option value="overviewer">Overviewer</option>
				</select>
			</div>
		</div>
		<div style="text-align:right; margin-top:50px;">
			<button class="fdms-btn" type="submit">Add User</button>
		</div>
	</form>	
</div>



<script>
$(document).ready(function(){

	fetchData();
	
	function fetchData() {
		$('.fdms-table').css('opacity', '0.4');
		
		var data = {
			_token : '{{csrf_token()}}',
			s : $('#searchtext').val()
		};
		
		$.post({
			url: "{{ url('/admin/get-user-data') }}",
			dataType: 'json',
			data:data,
			success: function (e) {
				if (e.success == true) {
					$('.fdms-table tbody').empty();
					
					for (item of e.data) {
						var actions = '<a href="#" class="scrap-btn" style="background:#C4C4C4; padding:4px 20px; color:#444; display: inline-block; margin-right:2px;">Scrap</a><a href="#" class="handover-btn" style="background:#C4C4C4; padding:4px 20px; color:#444; display: inline-block;">Handover</a>';
						
						var html = '<tr data-item-id="'+ item.id +'">';
						// html += '<td><input type="checkbox"></td>';
						html += '<td>'+ item.name +'</td>';
						html += '<td>'+ item.login_id +'</td>';
						html += '<td>'+ item.type +'</td>';
						html += '<td>'+ item.email +'</td>';
						html += '<td>'+ item.mobile +'</td>';
						/*html += '<td>'+ item.tracking_id +'</td>';
						html += '<td>'+ item.sku +'</td>';
						html += '<td>'+ item.l4_origin_address +'</td>';
						html += '<td>'+ item.damage_status +'</td>';
						html += '<td>'+actions+'</td>';
						html += '</tr>';
						*/
						$('.fdms-table tbody').append(html);
					}
					
				} else {
					toastr.error(e.error_message);
				}
				$('.fdms-table').css('opacity', '1');
			},
			error: function (e) {
				toastr.error('Error occured. Please try again or contact your service provider!');
				$('.fdms-table').css('opacity', '1');
			}
		});
	}
	
	$('#send-form').on('submit', function (e) {    
	if (!e.isDefaultPrevented()) {
	e.preventDefault();
	
		var data = new FormData($(this)[0]);
		data.append("_token", '{{csrf_token()}}');
		
		$('#send-form').css('opacity', '0.1');
		
		$.ajax({		 
			url: "{{ url('/admin/add-user') }}",
			type: 'post',
			
			async: true,
			dataType: 'json',
			
			data:data,
			success: function (e) {
				if (e.success == true) toastr.success(e.message);
				else toastr.error(e.error_message);
				$('#send-form').css('opacity', '1');
			},
			error: function (e) {
				toastr.error('Error occured. Please try again or contact your service provider!');
				$('#send-form').css('opacity', '1');
			},
			cache: false,
			contentType: false,
			processData: false
		});
	}
	});
	
	
});
</script>
	<div>
		<h4>Existing FDMS Users</h4>
	</div>
	<table class="table fdms-table" style="width:100%">
		<thead>
		<tr>
			<th>Username</th>
			<th>LoginID</th>
			<th>User Type</th>
			<th>Email</th>
			<th>Mobile</th>
		</tr>
		</thead>
		<tbody>
		
		</tbody>
	</table>

@endsection