@extends('layouts.app')

@section('content')


<style>
.package-list input{margin-bottom:10px;}
</style>

<div>
	<div>
		<a class="fdms-btn" href="{{ url('/bin-change') }}">Bin/Case Change</a>
	</div>
	
	<div class="scan-bin-1">
		<div class="fdms-inputs">
			<div class="form-group">
				<label class="control-label">Scan BIN/Case
				</label>
				<input class="form-control" name="bin_1">
			</div>
		</div>
		<div style="text-align:right; margin-top:50px;">
			<button class="fdms-btn" type="submit">Next</button>
		</div>
	</div>
	
	<div class="scan-packages" style="display:none;">
		<div class="fdms-inputs">
			<div class="form-group">
				<label class="control-label">Scan Packages
				</label>
				<div class="package-list">
					<input class="form-control">
				</div>
				
				<a href="#" class="fdms-btn add-new-package">Add new</a>
			</div>
		</div>
		<div style="text-align:right; margin-top:50px;">
			<button class="fdms-btn" type="submit">Next</button>
		</div>
	</div>
	
	<div class="scan-bin-2" style="display:none">
		<div class="fdms-inputs">
			<div class="form-group">
				<label class="control-label">Destination BIN/Case
				</label>
				<input class="form-control" name="bin_2">
			</div>
		</div>
		<div style="text-align:right; margin-top:50px;">
			<button class="fdms-btn" type="submit">Confirm Transfer</button>
		</div>
	</div>
	
</div>



<script>
$(document).ready(function() {
	
	$('.scan-bin-1 button').click(function() {
		if ($('.scan-bin-1 input').val() == '') {
			toastr.error("Please scan Bin / Case Number");
			return;
		}
		$('.scan-bin-1').hide();
		$('.scan-packages').show();
	});
	
	$('.scan-packages button').click(function() {
		var filledAny = false;
		$('.scan-packages .package-list input').each(function() {
			if ($(this).val() != '') filledAny = true;
		});
		
		if (!filledAny) {
			toastr.error("Please scan at least one package");
			return;
		}
		$('.scan-packages').hide();
		$('.scan-bin-2').show();
	});
	
	$('.scan-bin-2 button').click(function() {
		
		var bin1 = $('.scan-bin-1 input').val();
		var bin2 = $('.scan-bin-2 input').val();
		
		var packageList = [];
		$('.scan-packages .package-list input').each(function() {
			if ($(this).val() != '') packageList.push($(this).val());
		});
		
		
		if (bin1 == '') {
			toastr.error("Please scan Bin / Case Number first.");
			$('.scan-bin-2').hide();
			$('.scan-bin-1').show();
			return;
		}
		
		if (bin2 == '') {
			toastr.error("Please scan destination Bin / Case Number.");
			return;
		}
		
		// window.location.href = '{{url("/")}}/inbound-details/' + bin1 + '/' + bin2;
		
		
		$('.scan-bin-1, .scan-packages, .scan-bin-2').css('opacity', '0.2');
		
		$.ajax({
			url: "{{ url('/bin-change-submit') }}",
			type: 'post',
			dataType: 'json',
			data: {_token: '{{csrf_token()}}', bin1: bin1, bin2: bin2, package_list: JSON.stringify(packageList)},
			success: function (e) {
				if (e.success == true) {
					toastr.success(e.message);
					$('.scan-bin-2').html('<p>' + e.message + '. <a href="{{url('/bin-change')}}">Scan again</a></p>');
					
				} else {
					toastr.error(e.error_message);
				}
				$('.scan-bin-1, .scan-packages, .scan-bin-2').css('opacity', '1');
			},
			error: function (e) {
				toastr.error('Something went wrong. Please reload page and try again');
				$('.scan-bin-1, .scan-packages, .scan-bin-2').css('opacity', '1');
			}
		});
		
	});
	
	
	$('.add-new-package').click(function() {
		$('.package-list').append('<input class="form-control">');
		
	});

});

</script>

@endsection