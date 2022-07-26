@extends('admin.layout')


@section('subcontent')

<style>

</style>

<div>
	<!--
	<h3 style="margin-bottom:50px;">Product handover</h3>
	
	<div style="display:flex; justify-content:space-between; flex-wrap:wrap;">
		<div class="form-group" style="max-width:100%; width:440px;">
			<label class="control-label">Search Sellers</label>
			<div class="input-group">
				<input type="text" id="searchtext" class="form-control" placeholder="Search by seller’s name or phone number">
				<span class="input-group-btn">
					<button class="btn" id="searchbtn" type="button" style="border-radius:0; border:1px solid #ced4da;">Go!</button>
				</span>
			</div>
		</div>
		<div class="form-group">
			<label class="control-label">&nbsp;</label>
			<button href="#" class="fdms-btn master-sheet-btn" style="display:block;">Create Master Sheet</button>
		</div>
		
	</div>
	
	-->
	
<style>

.fdms-table{box-shadow: 0 0 10px #ccc; margin-bottom:40px;}
.fdms-table th{background:#2366B5; color:#fff; font-weight:normal; border:0 !important;}
.fdms-table td{background:#fff; border:0;}

</style>
	
<script>

$(document).ready(function() {
	fetchData();
	
	function fetchData() {
		$('.fdms-table').css('opacity', '0.4');
		
		var data = {
			_token : '{{csrf_token()}}',
			s : $('#searchtext').val()
		};
		
		$.post({
			url: "{{ url('/get-calendar-data') }}",
			dataType: 'json',
			data:data,
			success: function (e) {
				if (e.success == true) {
					$('.fdms-table tbody').empty();
					
					for (item of e.data) {
						var actions = '<a href="#" class="scrap-btn" style="background:#C4C4C4; padding:4px 20px; color:#444; display: inline-block; margin-right:2px;">Scrap</a><a href="#" class="handover-btn" style="background:#C4C4C4; padding:4px 20px; color:#444; display: inline-block;">Handover</a>';
						
						var html = '<tr data-item-id="'+ item.id +'">';
						// html += '<td><input type="checkbox"></td>';
						html += '<td>'+ item.holiday_type +'</td>';
						html += '<td>'+ item.holiday_date +'</td>';
						/*
						html += '<td>'+ item.seller_phone_no +'</td>';
						html += '<td>'+ item.order_number +'</td>';
						html += '<td>'+ item.tracking_id +'</td>';
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


	$('body').on('click', '.confirm-btn', function(e) {
		
		e.preventDefault();
		var data = {
			_token: '{{csrf_token()}}',
			holiday_name: $('#holiday_name').val(),
			holiday_date: $('#holiday_date').val()
		};
		
		$.post({
			url: "{{ url('/admin/calendar-update') }}",
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



	$('#searchbtn').click(function() {
		fetchData();
	});
	
	
	
	
	/*
	
	$('body').on('click', '.scrap-btn, .handover-btn, .scrap-selected-btn, .handover-selected-btn, .master-sheet-btn', function(e) {
		
		e.preventDefault();
		
		var action = '';
		var item_ids = [];
		
		if ($(this).hasClass('scrap-btn')) {
			action = 'scrap';
			item_ids.push($(this).closest('tr').attr('data-item-id'));
			
		} else if ($(this).hasClass('handover-btn')) {
			action = 'handover';
			item_ids.push($(this).closest('tr').attr('data-item-id'));
			
		} else if ($(this).hasClass('scrap-selected-btn')) {
			action = 'scrap';
			$('.fdms-table tbody tr td:first-child input').each(function() {
				if ($(this).is(':checked')) item_ids.push($(this).closest('tr').attr('data-item-id'));
			});
			
			if (item_ids.length < 1) {
				toastr.error('Please select items first');
				return;
			}
			
		} else if ($(this).hasClass('handover-selected-btn')) {
			action = 'handover';
			$('.fdms-table tbody tr td:first-child input').each(function() {
				if ($(this).is(':checked')) item_ids.push($(this).closest('tr').attr('data-item-id'));
			});
			
			if (item_ids.length < 1) {
				toastr.error('Please select items first');
				return;
			}
			
		}

		else if ($(this).hasClass('master-sheet-btn')) {
			action = 'master-sheet';
			$('.fdms-table tbody tr td:first-child input').each(function() {
				if ($(this).is(':checked')) item_ids.push($(this).closest('tr').attr('data-item-id'));
			});
			
			if (item_ids.length < 1) {
				toastr.error('Please select items first');
				return;
			}
			
		}
		
		 else {
			action = 'unknown-action';
		}
		
		
		var data = {
			_token: '{{csrf_token()}}',
			action: action,
			item_ids: JSON.stringify(item_ids)
		};
		
		$.post({
			url: "{{ url('/mark-as-handover') }}",
			data: data,
			dataType: 'json',
			success: function (e) {
				if (e.success == true) {
					toastr.success(e.message);
					fetchData();
				}
				else {
					toastr.error(e.error_message);
				}
			},
			error: function (e) {
				toastr.error('Please check your internet connection and try again.');
			}
			
		});
		
	});
	

	$('.fdms-table thead th input[type="checkbox"]').change(function() {
		$('.fdms-table tbody td input[type="checkbox"]').prop('checked', $(this).prop('checked'));
	});
	*/
	
});

</script>

	<div>
		<form id="send-form">
			<div class="fdms-inputs" style="">
				<div class="form-group">
					<label class="control-label">Name of Holiday</label>
					<input class="form-control" id = "holiday_name">
				</div>
				
				<div class="form-group">
					<label class="control-label">Date of Holiday </label>
				    <input type="date" class="form-control"  id="holiday_date">
				</div>
			</div>
			<div style="text-align:right; margin-top:50px;">
				<a class="fdms-btn confirm-btn" href="#">Submit Holiday</a>
			</div>
		</form>	
	</div>


		<div class="form-group">
			<label class="control-label">List of Holiday</label>
		</div>

	<table class="table fdms-table" style="width:100%">
	<thead>
	  <tr>

	    <th>Holiday Name</th>
		<th>Date of Holiday</th>
	  </tr>
	</thead>
	<tbody>
	
	</tbody>
	</table>
	<!--
	<a href="#" class="fdms-btn scrap-selected-btn">Scrap Selected</a> <a href="#" class="fdms-btn handover-selected-btn">Handover Selected</a>
-->
	
</div>



@endsection