<?php

namespace App\Http\Controllers\Scrap;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ScrapController extends Controller {
	
	public function scrap(Request $request) {
		return view('scrap/scrap');
		
	}
	
	public function getScrapData(Request $request) {
		
		$s = $request->get('s');
		
		$start_date = $request->get('start_date');
		$end_date = $request->get('end_date');
		
		$builder = DB::table('failed_delivery')
						->where('status', 9)
						->where('order_created_at', '>=', $start_date)
						->where('order_created_at', '<=', $end_date);
		
		
		if ($s != '') {
			$builder->whereNested(function($query) use ($s) {
				$query
					->where('seller_name', 'like', '%' . $s . '%')
					->orWhere('seller_phone_no', 'like', '%' . $s . '%');
			});
		}
		
		$data = $builder->get();
		
		
		return json_encode(['success' => true, 'data' => $data]);
		
	}
	
	
	
	public function retriveFromScrap(Request $request) {
		
		
		$ids = json_decode($request->get('ids'));
		
		if (count($ids) < 1) return json_encode(['success' => false, 'error_message' => 'please select items to retrive']);
		
		$modified = DB::table('failed_delivery')
							->whereIn('id', $ids)
							->where('status', 9)
							->update([
								'status' => 1
							]);
		
		return json_encode(['success' => true, 'message' => $modified . ' items retrived from scrap successfully']);
		
	}
	
}



