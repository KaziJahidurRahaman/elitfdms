<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReportController extends Controller {
	
	public function report(Request $request) {
		return view('report/report');
		
	}
	
	public function getReportData(Request $request) {
		
		if ($request->get('report_type') == 'inbound') {
			$type_status = 1;
			
		} else if ($request->get('report_type') == 'handover') {
			$type_status = 5;
			
		} else if ($request->get('report_type') == 'scrapped') {
			$type_status = 9;
			
		} else {
			return json_encode(['success' => false, 'error_message' => 'invalid report type']);
		}
		
		
		if ($request->get('damage_status') == 'damaged') {
			$damage_status = "Damaged";
			
		} else if ($request->get('damage_status') == 'ok') {
			$damage_status = "Ok";
			
		} else {
			return json_encode(['success' => false, 'error_message' => 'invalid action']);
		}
		
		

		$start_date = $request->get('start_date');
		$end_date = $request->get('end_date');
		
		
		$builder = DB::table('failed_delivery')
						->where('status', $type_status)
						->where('damage_status', $damage_status)
						->where('order_created_at', '>=', $start_date)
						->where('order_created_at', '<=', $end_date);
		
		
		$data = $builder->limit(100)->get();
		
		
		return json_encode(['success' => true, 'data' => $data]);
		
	}
	
	
}



