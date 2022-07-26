@extends('layouts.app')

@section('content')


<style>

</style>

<div>
	<h3 style="margin-bottom:50px;">Scrap</h3>
	
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
			<label class="control-label">Date Range</label>
			<div style="display:block;">
				<input type="date" style="border: 1px solid #ced4da; padding:5px;" value="{{date('Y-m-d', strtotime('-7 days'))}}" id="start-date">
				<input type="date" style="border: 1px solid #ced4da; padding:5px;" value="{{date('Y-m-d')}}" id="end-date">
			</div>
		</div>
	</div>
	<div style="margin-top:30px;">
		<a href="#" class="fdms-btn download-btn">Download All</a> &nbsp; <a href="#" class="fdms-btn retrive-btn">Retrieve from the scrap</a>
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
			s : $('#searchtext').val(),
			start_date: $('#start-date').val(),
			end_date: $('#end-date').val()
		};
		
		$.post({
			url: "{{ url('/get-scrap-data') }}",
			dataType: 'json',
			data:data,
			success: function (e) {
				if (e.success == true) {
					$('.fdms-table tbody').empty();
					
					for (item of e.data) {
						var html = '<tr data-item-id="'+ item.id +'">';
						html += '<td><input type="checkbox"></td>';
						html += '<td>'+ item.seller_name +'</td>';
						html += '<td>'+ item.seller_phone_no +'</td>';
						html += '<td>12-12-2020</td>';
						html += '<td>'+ item.order_number +'</td>';
						html += '<td>'+ item.tracking_id +'</td>';
						html += '<td>'+ item.sku +'</td>';
						html += '<td>'+ item.damage_status +'</td>';
						html += '</tr>';
						
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

	$('#searchbtn').click(function() {
		fetchData();
	});
	
	
	

	
	
	
	$('body').on('click', '.retrive-btn', function(e) {
		
		e.preventDefault();
		
		var ids = [];
		
		$('.fdms-table input').each(function() {
			if ($(this).is(":checked")) ids.push($(this).closest('tr').attr('data-item-id'));
		});
		
		if (ids.length < 1) {
			toastr.error('Please select items to retrive.');
			return;
		}
		
		var data = {
			_token: '{{csrf_token()}}',
			ids: JSON.stringify(ids)
		};
		
		$.post({
			url: "{{ url('/retrive-from-scrap') }}",
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
				toastr.error('Error occured. Please try again or contact your service provider!');
			}
			
		});
		
	});
	
	
	$('body').on('click', '.download-btn', function() {

		var data = '';
		$('.fdms-table th').each(function() {
			if ($(this).index() != 0) data += $(this).text() + ',';
		});
		data = data.substring(0, data.length - 1);
		data += '\n';

		$('.fdms-table tbody tr').each(function() {
			$(this).children('td').each(function() {
				if ($(this).index() != 0) data += $(this).text().split(',').join(' ') + ',';
				
			});
			data = data.substring(0, data.length - 1);
			data += '\n';
		});
		
		data = "data:text/csv;charset=utf-8," + data;
		
		var filename = 'scrap_report.csv';
		var encodedUri = encodeURI(data);
		var link = document.createElement("a");
		link.setAttribute("href", encodedUri);
		link.setAttribute("download", filename);
		document.body.appendChild(link);

		link.click();
		
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
		<th>Seller’ Name</th>
		<th>Phone Number</th>
		<th>Scrapped Date</th>
		<th>Order Number</th>
		<th>Tracking ID</th>
		<th>SKU</th>
		<th>Damage Status</th>
	  </tr>
	</thead>
	<tbody>
	
	</tbody>
	</table>
	
	
	
</div>


@endsection