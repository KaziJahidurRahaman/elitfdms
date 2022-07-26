<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class DashboardController extends Controller {
	
	public function index(Request $request) {
		
		$inbound = DB::select("select count(*) as total from failed_delivery where status = 1");
		$inbound = $inbound[0]->total;
		
		$handover = DB::select("select count(*) as total from failed_delivery where status = 5");
		$handover = $handover[0]->total;
		
		$scrap = DB::select("select count(*) as total from failed_delivery where status = 9");
		$scrap = $scrap[0]->total;

//		default = uploaded by fd csv but not inbounded yet, status = 0
		$default = DB::select("select count(*) as total from failed_delivery where status = 0");
		$default = $default[0]->total;


		//for charts


		//for inbound
		 $chartinbound_value=DB::table('failed_delivery')
						->select(DB::raw('count(*) as count'))
						->where('status', 1)
						->groupBy(DB::raw("Month(order_created_at)"))
						->pluck('count');

		 $chartinbound_month=DB::table('failed_delivery')
						->select(DB::raw('Month(order_created_at) as month'))
						->where('status', 1)
						->groupBy(DB::raw("Month(order_created_at)"))
						->pluck('month');
						//->get();

		$chartinbound_data= array(0,0,0,0,0,0,0,0,0,0,0,0);

		foreach ($chartinbound_month as $index => $month) {
			 $chartinbound_data[$month]=$chartinbound_value[$index];
		}


		//for handover
		$charthandover_value=DB::table('failed_delivery')
						->select(DB::raw('count(*) as count'))
						->where('status', 5)
						->groupBy(DB::raw("Month(order_created_at)"))
						->pluck('count');

		$charthandover_month=DB::table('failed_delivery')
						->select(DB::raw('Month(order_created_at) as month'))
						->where('status', 5)
						->groupBy(DB::raw("Month(order_created_at)"))
						->pluck('month');

		$charthandover_data= array(0,0,0,0,0,0,0,0,0,0,0,0);
		foreach ($charthandover_month as $index => $month) {
			$charthandover_data[$month]=$charthandover_value[$index];
	   	}


		//for scrap
		$chartscrap_value=DB::table('failed_delivery')
						->select(DB::raw('count(*) as count'))
						->where('status', 9)
						->groupBy(DB::raw("Month(order_created_at)"))
						->pluck('count');

		$chartscrap_month=DB::table('failed_delivery')
						->select(DB::raw('Month(order_created_at) as month'))
						->where('status', 9)
						->groupBy(DB::raw("Month(order_created_at)"))
						->pluck('month');

		$chartscrap_data=array(0,0,0,0,0,0,0,0,0,0,0,0);
		foreach ($chartscrap_month as $index => $month) {
					$chartscrap_data[$month]=$chartscrap_value[$index];
				}

		//return $chartinbound_data;
		
		//Log::info($chartinbound);
		
		return view('dashboard/dashboard', [
			'inbound' => $inbound, 
			'handover' => $handover, 
			'scrap' => $scrap,
			'default' => $default, 
			'chartinbound_data'=>$chartinbound_data,
			'charthandover_data'=>$charthandover_data,
			'chartscrap_data'=>$chartscrap_data
		]);
		
	}
	
}



