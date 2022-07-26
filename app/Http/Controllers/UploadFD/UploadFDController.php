<?php

namespace App\Http\Controllers\UploadFD;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendSMSJob;
use App\Jobs\SendEmailJob;



class UploadFDController extends Controller {
	
	public function index(Request $request) {
		return view('uploadFD/uploadFD');
		
	}
	
	
	
	public function upload(Request $request) {
		$dataFile = $request->file('data-file');
		
		if(!isset($dataFile)) return json_encode(['success' => false, 'error_message' => 'Please select file']);
		
		$mime = $dataFile->getMimeType();
		
		if (!in_array($mime, ['txt' => 'text/plain'])) return json_encode(['success' => false, 'error_message' => 'File type is not supported.']);
		
		
		
		$fd_data = [];

		try{
			$file = fopen($dataFile, "r");
			while(!feof($file)) {
				$fd_data[]= fgetcsv($file);
			}
			fclose($file);
			
		} catch(\Exception $excep) {
			return  '{"Success":false,"ErrorMessage":"File verification failed."}';
		}
		
		
		
		$insert_data = [];
		$insert_data_sms=[];
		$insert_data_emails=[];
		
		foreach ($fd_data as $single) {
			
			if (is_array($single) && count($single) >= 14) {
				$insert_data[] = [
					'bin_no' => $single[0],
					'package_no' => $single[1],
					'seller_id' => $single[2],
					'seller_name' => $single[3],
					'seller_phone_no' => $single[4],
					'seller_email' => $single[5],
					'order_number' => $single[6],
					'tracking_id' => $single[7],
					'sku' => $single[8],
					'sku_details' => $single[9],
					'dropoff_station_name' => $single[10],
					'current_dex_status' => $single[11],
					'l4_origin_address' => $single[12],
					'order_created_at' => $single[13]
				];


				$insert_data_sms []=[
					'tracking_id'=>$single[7],
                    'phone'=>$single[4],
                    'category'=>'uploaded',
                    'sms_status'=>0
                ];

				$insert_data_emails []=[
					'tracking_id'=>$single[7],
                    'email'=>$single[5],
                    'category'=>'uploaded',
                    'email_status'=>0
                ];
			}
			
		}
		
		DB::table('failed_delivery')->insert($insert_data);
		DB::table('sms')->insert($insert_data_sms);
		DB::table('emails')->insert($insert_data_emails);
		
		SendSMSJob::dispatch();
		SendEmailJob::dispatch();
		
		return json_encode(['success' => true, 'total_fd' => count($insert_data)]);
		
		
		
	}
	
}



