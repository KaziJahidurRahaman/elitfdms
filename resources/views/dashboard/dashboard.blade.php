@extends('layouts.app')

@section('content')




<style>

.overviewes{display:flex; justify-content:space-between; column-gap:30px;}
.overviewes > div{
    text-align: center;
    box-shadow: 1px 1px 5px #aaa;
    border: 1px solid #ddd;
    border-radius: 2px;
    padding: 30px 20px;
    width: 33%;
}

.overviewes h2{color:#2366B5; margin-top: 30px;}

</style>

<div>
	<h3 style="margin-bottom:50px;">Overview</h3>
	<div class="overviewes">
		<div>
			<h4>Total Inbounded Package</h4>
			<h2>{{$inbound}}</h2>
		</div>
		<div>
			<h4>Total Collected Package</h4>
			<h2>{{$handover}}</h2>
		</div>
		<div>
			<h4>Total Scrapped Package</h4>
			<h2>{{$scrap}}</h2>
		</div>
		<div>
			<h4>Uninbounded Package</h4>
			<h2>{{$default}}</h2>
		</div>
	</div>
	<hr style="margin-top:60px;">
</div>

<div>
	<div id ="chart-container">
		<script src="https://code.highcharts.com/highcharts.js"></script>

		<!-- <h4>FDMS Histogram</h4> -->
		<script>
			var chartinbound_data=<?php echo json_encode($chartinbound_data)?>;
			var charthandover_data=<?php echo json_encode($charthandover_data)?>;
			var chartscrap_data=<?php echo json_encode($chartscrap_data)?>;
			//alert(chartinbound_data);
			Highcharts.chart('chart-container',{
				title: {
					text: 'FDMS Histogram'
				},
				xAxis: {
					categories: ['Jan','Feb','Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
				},
				yAxis: {
					title: {
						text: 'Number of Products'
					}
				},
				series: [{
					name: 'Inbound',
					data: chartinbound_data
				}, 
				{
					name: 'Handover',
					data: charthandover_data
				},
				{
					name: 'Scrap',
					data: chartscrap_data
				}]
			})
		</script>
	</div>
</div>



@endsection