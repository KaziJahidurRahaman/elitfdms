@extends('layouts.app')

@section('content')


<style>
.details{padding:30px; background:#C4C4C4; display:flex; flex-wrap:wrap; justify-content:space-between;}
.details > p{width:100%; font-weight:bold;}
.details > div{display:flex; flex-wrap:wrap; justify-content:space-between; width:50%;}
.details > div > div{ width:50%; margin-bottom:40px;}

</style>

<div>
	<div>
		<a class="fdms-btn" href="{{ url('/inbound') }}">Inbound Product</a>
	</div>
	
	@if ($data != null)
	<div class="fdms-inputs">
		<div class="form-group">
			<label class="control-label">Scan BIN/Case
			</label>
			<input class="form-control" value="{{$data->bin_no}}" disabled style="background:#C4C4C4; cursor:default; padding:10px 30px;">
		</div>
		
		<div class="form-group">
			<label class="control-label">Scan Code
			</label>
			<input class="form-control" value="{{$data->package_no}}" disabled style="background:#C4C4C4; cursor:default; padding:10px 30px;">
		</div>
	</div>
	
	<div class="details">
		<p>Seller’s and product details</p>
		
		<div>
			<div>
				<b>Name</b><br>
				<span>{{$data->seller_name}}</span>
			</div>
			<div>
				<b>Email</b><br>
				<span>{{$data->seller_email}}</span>
			</div>
			<div>
				<b>Phone Number</b><br>
				<span>{{$data->seller_phone_no}}</span>
			</div>
		</div>
		
		<div>
			<div>
				<b>Tracking ID</b><br>
				<span>{{$data->tracking_id}}</span>
			</div>
			<div>
				<b>SKU</b><br>
				<span>{{$data->sku}}</span>
			</div>
			<div>
				<b>Order Number</b><br>
				<span>{{$data->order_number}}</span>
			</div>
		</div>
		
	</div>
	
	<div style="text-align:right; margin-top:50px;">
		<a class="fdms-btn inbound-as-damaged" href="#">Inbound as damaged</a> &nbsp; 
		<a class="fdms-btn" href="{{ url('/inbound') }}">Cancel</a> &nbsp; 
		<a class="fdms-btn inbound-as-ok" href="#">Inbound</a> &nbsp; 
	</div>
	
	@else
		<p>Invalid Details, Item not found.</p>
	@endif
	
</div>


@if ($data != null)
<script>
$(document).ready(function() {
	
	$('.inbound-as-damaged, .inbound-as-ok').click(function(e) {
		
		e.preventDefault();
		var data = {
			_token: '{{csrf_token()}}',
			action: $(this).hasClass('inbound-as-damaged') ? 'inbound-as-damaged' : 'inbound-as-ok',
			bin_no: '{{$data->bin_no}}',
			package_no: '{{$data->package_no}}'
		};
		
		$.post({
			url: "{{ url('/inbound-as') }}",
			data: data,
			dataType: 'json',
			success: function (e) {
				if (e.success == true) toastr.success('Successfully inbounded!!');
				else toastr.error(e.error_message);
			},
			error: function (e) {
				toastr.error('Error occured. Please try again or contact your service provider!');
			}
			
		});
		
	});
	
});

</script>
@endif
@endsection