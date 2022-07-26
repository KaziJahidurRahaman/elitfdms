@extends('layouts.app')

@section('content')


<style>

</style>

<div>
	<div>
		<a class="fdms-btn" href="{{ url('/inbound') }}">Inbound Product</a>
	</div>
	
	<div class="scan-bin-box">
		<div class="fdms-inputs">
			<div class="form-group">
				<label class="control-label">Scan BIN/Case
				</label>
				<input class="form-control" name="bin_no">
			</div>
		</div>
		<div style="text-align:right; margin-top:50px;">
			<button class="fdms-btn" type="submit">Next</button>
		</div>
	</div>
	
	<div class="scan-package-box" style="display:none">
		<div class="fdms-inputs">
			<div class="form-group">
				<label class="control-label">Scan Package
				</label>
				<input class="form-control" name="package_no">
			</div>
		</div>
		<div style="text-align:right; margin-top:50px;">
			<button class="fdms-btn" type="submit">Seller's and Product Details</button>
		</div>
	</div>
	
</div>



<script>
$(document).ready(function() {
	
	$('.scan-bin-box button').click(function() {
		if ($('.scan-bin-box input').val() == '') {
			toastr.error("Please scan Bin / Case Number");
			return;
		}
		$('.scan-bin-box').hide();
		$('.scan-package-box').show();
	});
	
	$('.scan-package-box button').click(function() {
		
		var binNo = $('.scan-bin-box input').val();
		var packageNo = $('.scan-package-box input').val();
		
		if (binNo == '') {
			toastr.error("Please scan Bin / Case Number first.");
			$('.scan-package-box').hide();
			$('.scan-bin-box').show();
			return;
		}
		
		if (packageNo == '') {
			toastr.error("Please scan Package Number.");
			return;
		}
		
		window.location.href = '{{url("/")}}/inbound-details/' + binNo + '/' + packageNo;
		
	});
	
	

});

</script>

@endsection