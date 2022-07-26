@extends('layouts.app')

@section('content')


<style>

</style>

<div>
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
			url: "{{ url('/get-handover-data') }}",
			dataType: 'json',
			data:data,
			success: function (e) {
				if (e.success == true) {
					$('.fdms-table tbody').empty();
					
					for (item of e.data) {
						var actions = '<a href="#" class="scrap-btn" style="background:#C4C4C4; padding:4px 20px; color:#444; display: inline-block; margin-right:2px;">Scrap</a><a href="#" class="handover-btn" style="background:#C4C4C4; padding:4px 20px; color:#444; display: inline-block;">Handover</a>';
						
						var html = '<tr data-item-id="'+ item.id +'">';
						html += '<td><input type="checkbox"></td>';
						html += '<td>'+ item.id +'</td>';
						html += '<td>'+ item.seller_name +'</td>';
						html += '<td>'+ item.seller_phone_no +'</td>';
						html += '<td>'+ item.order_number +'</td>';
						html += '<td>'+ item.tracking_id +'</td>';
						html += '<td>'+ item.sku +'</td>';
						html += '<td>'+ item.l4_origin_address +'</td>';
						html += '<td>'+ item.damage_status +'</td>';
						html += '<td>'+actions+'</td>';
						html += '</tr>';
						
						$('.fdms-table tbody').append(html);
					}
					
				} else {
					toastr.error(e.error_message);
				}
				$('.fdms-table').css('opacity', '1');
			},
			error: function (e) {
				toastr.error('Please check your internet connection and try again.');
				$('.fdms-table').css('opacity', '1');
			}
		});
	}

	$('#searchbtn').click(function() {
		fetchData();
	});
	
	
	
	
	
	
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
		
		if (action = 'master-sheet') {
			var data = {
				_token: '{{csrf_token()}}',
				action: action,
				item_ids: JSON.stringify(item_ids)
				};
				$.post({
					type: 'GET',
					url: '/master-sheet',
					data: data,
					dataType: 'json',
					// xhrFields: {
						// 	responseType: 'blob'
					// },
					success: function(response){
						var link = document.createElement('a');
						link.href = response.data;
						link.dispatchEvent(new MouseEvent('click'));
					},
					error: function(blob){
						toastr.error('Error occured. Please try again or contact your service provider!');
						console.log(blob);
					}
				});
		return;
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
	
	
});

</script>
	
	<table class="table fdms-table" style="width:100%">
	<thead>
	  <tr>
		<th><input type="checkbox"></th>
		<th>Serial</th>
		<th>Seller Name</th>
		<th>Seller Phone</th>
		<th>Order Number</th>
		<th>Tracking ID</th>
		<th>SKU</th>
		<th>Located at</th>
		<th>Damage Status</th>
		<th>Action</th>
	  </tr>
	</thead>
	<tbody>
	
	</tbody>
	</table>
	
	<a href="#" class="fdms-btn scrap-selected-btn">Scrap Selected</a> <a href="#" class="fdms-btn handover-selected-btn">Handover Selected</a>
</div>



@endsection