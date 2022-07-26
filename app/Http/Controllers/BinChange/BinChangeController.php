<?php

namespace App\Http\Controllers\BinChange;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class BinChangeController extends Controller {
	
	public function scan(Request $request) {
		return view('binChange/scan');
		
	}
	
	
	public function change(Request $request) {
		
		
		$bin1 = $request->get('bin1');
		$bin2 = $request->get('bin2');
		
		$package_list = $request->get('package_list');
		$package_list = json_decode($package_list);
		
		
		$checkBin1 = DB::select("select count(*) as total from failed_delivery where bin_no = ?", [$bin1]);
		
		if (!(isset($checkBin1) && count($checkBin1) > 0)) return json_encode(['success' => false, 'error_message' => 'Source bin / case is empty or invalid number.']);
		if (intval($checkBin1[0]->total) == 0) return json_encode(['success' => false, 'error_message' => 'Source bin / case is empty or invalid number.']);
		
		
		$total_updated = DB::table('failed_delivery')
			->where('bin_no', $bin1)
			->whereIn('package_no', $package_list)
			->update([
				'bin_no' => $bin2
			]);
		
		return json_encode(['success' => true, 'message' => intval($total_updated) . ' items moved from bin '.$bin1.' to bin '. $bin2]);
		
	}
	
	
	
}



