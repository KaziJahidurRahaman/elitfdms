<?php

namespace App\Http\Controllers\Handover;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade;
use Illuminate\Http\Response;
use PDF;


class HandoverController extends Controller {
	
	public function handover(Request $request) {
		return view('handover/handover');
		
	}
	
	public function getHandoverData(Request $request) {
		
		$s = $request->get('s');
		
		$builder = DB::table('failed_delivery')->where('status', 1);
		
		
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
	
	
	public function markAsHandover(Request $request) {
		//return view("hsgdh");
		
		$action = $request->get('action');
		$item_ids = $request->get('item_ids');

		$item_ids = json_decode($item_ids);
		
		if ($action == 'scrap') {
			$new_status = 9;
			
		} else if ($action == 'handover') {
			$new_status = 5;
			
		} 
		elseif ($action == 'master-sheet') {
			$deliverys=$item_ids;
			$orders=[];
			$sellers=[];

			foreach ($deliverys as $delivery) {
				//delivery info
				$sellers[]= DB::table('failed_delivery')
							->where('id', $delivery)
							->value('seller_name');
				$orders[]= DB::table('failed_delivery')
							->select('id','seller_name','seller_phone_no','order_number', 'tracking_id','sku','l4_origin_address','damage_status' )
							->where('id', $delivery)
							->get();
			}

			if(count(array_unique($sellers)) > 1){
				return json_encode(['success' => false, 'error_message' => 'multiple sellers selected. please select one seller per sheet']);
			}

			else{
				$orders_json=json_encode($orders);
				$pdf = PDF::loadView('pdf.mastersheet', compact('orders'));		
				//return response()->download($pdf);

				return $pdf->download($sellers[1].'_Mastersheet_'.time().'.pdf');
			}		
		}
		
		else {
			return json_encode(['success' => false, 'error_message' => 'invalid action']);
		}
		
		
		$total_updated = DB::table('failed_delivery')
							->whereIn('id', $item_ids)
							->update([
								'status' => $new_status
							]);

		// $sms_table_insert = DB::table('sms')->insert([
		// 	'failed_delivery_id' => 1,
		// 	'phone' => '8801609433334',
		// 	'category' => 'handover',
		// 	'delivery_status' => 1,
		// 	'sms_status' => 0
		// 		]);

		return json_encode(['success' => true, 'message' => $total_updated . ' items '. $action . ' done successfully']);
		
	}


	public function masterSheet(Request $request)
	{
		//Log::info($request);
		//Log::info("mastersheet");

		$action = $request->get('action');
		$item_ids = $request->get('item_ids');

		$item_ids = json_decode($item_ids);
		Log::info($action);
		Log::info($item_ids);
		//Log::info($action);



		$deliverys=$item_ids;
		$orders=[];
		$sellers=[];

		foreach ($deliverys as $delivery) {
			//delivery info
			$sellers[]= DB::table('failed_delivery')
						->where('id', $delivery)
						->value('seller_name');
			$orders[]= DB::table('failed_delivery')
						->select('id','seller_name','seller_phone_no','order_number', 'tracking_id','sku','l4_origin_address','damage_status' )
						->where('id', $delivery)
						->get();
		}

		// Log::info("mastersheet");
		// Log::info($sellers);
		// Log::info($orders);
		// die();
		//die();

		if(count(array_unique($sellers)) > 1){
			return json_encode(['success' => false, 'error_message' => 'multiple sellers selected. please select one seller per sheet']);
		}

		else{
			// Log::info("-----------------------------------------------");
			// //Log::info($orders);
			 $orders_json=json_encode($orders);
			// // Log::info($orders_json);
			// // die();
			// //Log::info($orders_json);
			// $pdf = PDF::loadView('pdf.mastersheet', compact('orders'));
			// //Log::info($pdf);
			
			// Log::info("pdf generated");




			$pdf = PDF::loadView('pdf.mastersheet', compact('orders'));

			$path = public_path('mastersheets/');
			$fileName =  $sellers[0].'_'.time().'.'. 'pdf' ;
			Log::info("1");
			$pdf->save($path . '/' . $fileName);
	
			$pdf = public_path('pdf/'.$fileName);
			//return response()->$pdf;
			return $pdf;
			
			
			//return response()->download($pdf);
		}


			Log::info("Delivery ID");
	}
	
}



