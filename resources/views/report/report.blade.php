@extends('layouts.app')

@section('content')


<style>
.report-options select{
	background:#C4C4C4;
	border:none;
	outline:none;
	box-shadow:none !important;
	padding:10px;
	height:auto;
	border-radius:0;
	font-weight: bold;
    font-size: 18px;
}
</style>

<div>
	<h3 style="margin-bottom:50px;">Reports</h3>
	
	<div class="report-options" style="display:flex; justify-content:space-between; flex-wrap:wrap;">
		<div class="form-group" style="width:210px; max-width:100%">
			<label class="control-label">Select Report Type</label>
			<div class="input-group">
				<select class="form-control report-type">
					<option disabled selected>Select Report Type</option>
					<option value="inbound">Inbounded package report</option>
					<option value="handover">Total handover package report</option>
					<option value="scrapped">Total scrapped package report</option>
				</select>
			</div>
		</div>
		<div class="form-group" style="width:210px; max-width:100%">
			<label class="control-label">Select damage status</label>
			<div class="input-group">
				<select class="form-control damage-status">
					<option disabled selected>Select status</option>
					<option value="damaged">Damaged</option>
					<option value="ok">No Damage</option>
				</select>
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
		<a href="#" class="fdms-btn show-data-btn">Show 100 Rows</a> &nbsp; <a href="#" class="fdms-btn download-btn">Download Report</a>
	</div>
	
	
	
	
	
	
	
<style>

.fdms-table{box-shadow: 0 0 10px #ccc; margin-bottom:40px;}
.fdms-table th{background:#2366B5; color:#fff; font-weight:normal; border:0 !important;}
.fdms-table td{background:#fff; border:0;}

</style>
	
<script>

$(document).ready(function() {
	
	
	function fetchData() {
		
		$('.fdms-table').css('opacity', '0.4');
		
		var data = {
			_token : '{{csrf_token()}}',
			report_type : $('.report-type').val(),
			damage_status : $('.damage-status').val(),
			start_date: $('#start-date').val(),
			end_date: $('#end-date').val()
		};
		
		$.post({
			url: "{{ url('/get-report-data') }}",
			dataType: 'json',
			data:data,
			success: function (e) {
				if (e.success == true) {
					$('.fdms-table tbody').empty();
					
					for (item of e.data) {
						var html = '<tr>';
						html += '<td>'+ item.seller_id +'</td>';
						html += '<td>'+ item.seller_name +'</td>';
						html += '<td>'+ item.order_created_at +'</td>';
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

	$('.show-data-btn').click(function() {
		
		if ($('.report-type').val() == null) {
			toastr.error('Please select report type.');
			return;
		}
		if ($('.damage-status').val() == null) {
			toastr.error('Please select damage status.');
			return;
		}
		
		
		$('.fdms-table').show();
		fetchData();
	});
	
	
	
	
	$('body').on('click', '.download-btn', function() {

		var data = '';
		$('.fdms-table th').each(function() {
			data += $(this).text() + ',';
		});
		data = data.substring(0, data.length - 1);
		data += '\n';

		$('.fdms-table tbody tr').each(function() {
			$(this).children('td').each(function() {
				data += $(this).text().split(',').join(' ') + ',';
				
			});
			data = data.substring(0, data.length - 1);
			data += '\n';
		});
		
		data = "data:text/csv;charset=utf-8," + data;
		
		var filename = 'report.csv';
		var encodedUri = encodeURI(data);
		var link = document.createElement("a");
		link.setAttribute("href", encodedUri);
		link.setAttribute("download", filename);
		document.body.appendChild(link);

		link.click();
		
	});
	
	
	
});

</script>

	<table class="table fdms-table" style="width:100%; display:none;">
	<thead>
	  <tr>
		<th>Seller ID</th>
		<th>Seller Name</th>
		<th>Date</th>
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