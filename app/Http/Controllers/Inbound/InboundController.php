<?php

namespace App\Http\Controllers\Inbound;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class InboundController extends Controller {
	
	public function scan(Request $request) {
		return view('inbound/scan');
		
	}
	
	public function details(Request $request, $bin_no, $package_no) {
		
		$item = DB::select("select * from failed_delivery where bin_no = ? and package_no = ? and status in (0, 1)", [$bin_no, $package_no]);
		
		if (!(isset($item) && count($item) > 0)) return view('inbound/details', ['data' => null]);
		
		return view('inbound/details', ['data' => $item[0]]);
		
	}
	
	
	public function inboundAs(Request $request) {
		
		$find = DB::select("select * from failed_delivery where bin_no = ? and package_no = ? and status in (0, 1)", [$request->get('bin_no'), $request->get('package_no')]);
		
		if (!(isset($find) && count($find) > 0)) return json_encode(['success' => false, 'error_message' => 'package not found']);
		
		
		if ($request->get('action') == 'inbound-as-damaged') {
			$damage_status = "Damaged";
			
		} else if ($request->get('action') == 'inbound-as-ok') {
			$damage_status = "Ok";
			
		} else {
			return json_encode(['success' => false, 'error_message' => 'invalid action']);
		}
		
		DB::table('failed_delivery')
							->where('bin_no', $request->get('bin_no'))
							->where('package_no', $request->get('package_no'))
							->update([
								'damage_status' => $damage_status,
								'status' => 1
							]);
		
		return json_encode(['success' => true]);
		
	}
	
}



