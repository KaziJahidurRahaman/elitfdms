<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Illuminate\Support\Facades\Log;
use App\Jobs\SendSMSJob;
use App\Jobs\SendEmailJob;
use App\Mail\FDMSMail;

use App\Jobs\SMSJob;
use App\Jobs\EmailJob;



class AdminController extends Controller {
	
	public function binConfig(Request $request) {
		return view('admin/binConfig');
		
	}
	
	public function createBin(Request $request) {
		
		$existance = DB::select("select * from bins where bin_no = ?", [$request->get('bin_no')]);
		
		if (isset($existance) && count($existance) > 0) {
			
			DB::table('bins')
					->where('bin_no', $request->get('bin_no'))
					->update([
						'bin_no' => $request->get('bin_no'),
						'capacity' => $request->get('capacity'),
						'dop' => $request->get('dop')
					]);
					
			return json_encode(['success' => true, 'message' => 'Existing Bin Updated']);
			
		} else {
			
			DB::table('bins')->insert([
				'bin_no' => $request->get('bin_no'),
				'capacity' => $request->get('capacity'),
				'dop' => $request->get('dop')
			]);
			
			return json_encode(['success' => true, 'message' => 'Bin created successfully']);
			
		}
		
	}
	
	
	
	
	
	
	
	
	
	
	
	
	public function userManagement(Request $request) {
		return view('admin/userManagement');
		
	}

	public function getUserData(){
		//Log::info("getuserdata");
		$builder = DB::table('users');
		
		 
		json_encode($data = $builder->get());

		Log::info($data);
		return json_encode(['success' => true, 'data' => $data]);
	}
	
	
	public function addUser(Request $request) {
		
		$username = $request->get('username');
		$email = $request->get('email');
		$mobile = $request->get('mobile');
		$type = $request->get('type');
		
		if (in_array("", [$username, $email, $mobile, $type])) return json_encode(['success' => false, 'error_message' => 'Please fill the required informations']);
		
		
		$types = ['huboperator', 'overviewer'];
		if ($request->user()->type == 'superadmin') $types[] = 'admin';
		
		if (!in_array($type, $types)) return json_encode(['success' => false, 'error_message' => 'Invalid user type']);
		
		$existance = DB::select("select * from users where login_id = ?", [$username]);
		
		if (isset($existance) && count($existance) > 0) return json_encode(['success' => false, 'error_message' => 'username already exists']);
		
		
		$new_password = $this->generatePassword();
		$hash_password = \Hash::make($new_password);
		
		DB::table('users')->insert([
			'login_id' => $username,
			'type' => $type,
			'mobile' => $mobile,
			'email' => $email,
			'password' => $hash_password,
			'created_at' => date('Y-m-d H:i:s')
		]);

		$emailtableid=DB::table('emails')->insertGetId([
			'tracking_id' => NULL,
			'email' => $email,
			'category' => 'user_created',
			'delivery_status' => 'NULL',
			'email_status' => 0
			//'created_at' => date('Y-m-d H:i:s')
		]);



		$smstableid = DB::table('sms')->insertGetId([
			'tracking_id' => NULL, 
			'phone' => $mobile,
			'category' => 'user_created',
			'delivery_status' => 'NULL',
			'sms_status' => 0
			]);


		$emaildetails= [
			'username'=>$username,
			'email'=> $email,
			'data'=>$new_password,
			'emailtableid'=>$emailtableid
		];
		//exit;

		$smsdetails=[
			'username'=>$username,
			'email'=> $email,
			'mobile'=>$mobile,
			'data'=>$new_password,
			'smstableid'=>$smstableid,
			'msg'=>'Dear User, Your Username:'.$username . ' Your Password: '.$new_password
		];


		Log::info("SMS Job Dispatching");
		Log::info($smsdetails);
		SMSJob::dispatch($smsdetails);
		EmailJob::dispatch($emaildetails);

		return json_encode(['success' => true, 'message' => 'user ' . $username . ' created. password: ' . $new_password]);
		
	}
	
	
	private function generatePassword() {
		$vowels = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$vowelLength = strlen($vowels);
		$password = '';
		for ($i = 0; $i < 12; $i ++) $password .= $vowels[rand(0, $vowelLength - 1)];
		return $password;
		
	}
	
	
	
	
	
	
	
	
	
	
	public function dopMapping(Request $request) {
		return view('admin/dopMapping');
		
	}
	
	public function uploaddop(Request $request)
	{
		//Log::info($request);
		$dataFile = $request->file('data-file');
		//Log::info("bhdbhdbshfbdhbfhdbfhdbfhbdhbfhdbfhbdhfbhdbfhdbfhbdhfbdhbfhdbfhdhbfdhbfdh");
		if(!isset($dataFile)) return json_encode(['success' => false, 'error_message' => 'Please select file']);
		$mime = $dataFile->getMimeType();
		Log::info($mime);


		if (!in_array($mime, ['txt' => 'text/plain'])) return json_encode(['success' => false, 'error_message' => 'File type is not supported.']);
		
		
		
		$dopdata = [];

		try{
			$file = fopen($dataFile, "r");
			while(!feof($file)) {
				$dopdata[]= fgetcsv($file);
			}
			fclose($file);
			
		} catch(\Exception $excep) {
			return  '{"Success":false,"ErrorMessage":"File verification failed."}';
		}
		
		$insert_data = [];
		$insert_data_sms=[];
		
		foreach ($dopdata as $single) {			
			if (is_array($single) && count($single) >= 12) {

				$insert_data[] = [
					'seller_id' => $single[0],
					'seller_center_id' => $single[1],
					'seller_name' => $single[2],
					'drop_station' => $single[3],
					'station_code' => $single[4],
					'zone' => $single[5],
					'address' => $single[6],
					'email_address' => $single[7],
					'phone_number' => $single[8],
					'category' => $single[9],
					'poc' => $single[10],
					'active_status' => $single[11],
				];
			}
		}
		DB::table('dop_info')->insert($insert_data);
		Log::info(count($insert_data));
		return json_encode(['success' => true, 'total_dop' => count($insert_data)]);

	}
	
	
	
	
	
	
	
	public function scrapConfig(Request $request) {
		return view('admin/scrapConfig');
		
	}
	
	public function scrapConfigUpdate(Request $request) {
		
		$existance = DB::select("select * from scrap_config where product_type = ?", [$request->get('product_type')]);
		
		if (isset($existance) && count($existance) > 0) {
			
			DB::table('scrap_config')
					->where('product_type', $request->get('product_type'))
					->update([
						'day_of_scrap' => $request->get('day')
					]);
					
			return json_encode(['success' => true, 'message' => 'Scrap configuration updated successfully for product type: ' . $request->get('product_type')]);
			
		} else {
			
			DB::table('scrap_config')->insert([
				'product_type' => $request->get('product_type'),
				'day_of_scrap' => $request->get('day')
			]);
			
			return json_encode(['success' => true, 'message' => 'Scrap configuration created successfully for product type: ' . $request->get('product_type')]);
			
		}
		
	}
	
	


	public function mailAgeing(Request $request) {
		return view('admin/mailAgeing');
		
	}
	
	public function mailAgeingUpdate(Request $request) {
		
		$existance = DB::select("select * from fdms_config");
		if (isset($existance) && count($existance) > 0) {
			
			DB::table('fdms_config')
					->where('id', 1)
					->update([
						'mail_aging' => $request->get('mail_aging')
					]);
					
			return json_encode(['success' => true, 'message' => 'Mail Aging day Updated Successfull to : ' . $request->get('mail_aging')]);
			
		} else {
			
			DB::table('fdms_config')->insert([
				'mail_aging' => $request->get('mail_aging'),
			]);
			
			return json_encode(['success' => true, 'message' => 'Mail Aging day Upadated Succesfull to: ' . $request->get('mail_aging')]);
			
		}
		
	}



	public function calendar(Request $request) {
		return view('admin/calendar');
		
	}

	public function getCalendarData(Request $request) {
		//return '[{"id": "1", "Name": "Shirt"}, {"id": "2", "Name":"Pants"}]';
		//exit();
		

		$s = $request->get('s');
		
		$builder = DB::table('tbl_calendar');
		
		 
		$data = $builder->get();
		
		
		return json_encode(['success' => true, 'data' => $data]);
		
	}
	
	public function calendarUpdate(Request $request) {

		//Log::info($request);
		
		//$existance = DB::select("select * from scrap_config where product_type = ?", [$request->get('product_type')]);
		$holiday_name=$request->holiday_name;
		$holiday_date= $request->holiday_date;

		//Log::info($holiday_name);
		//Log::info($holiday_date);
		if (isset($holiday_name) && isset($holiday_date)) {
			
			DB::table('tbl_calendar')
				->insert([
				'holiday_type' => $request->get('holiday_name'),
				'holiday_date' => $request->get('holiday_date')
			]);
			return json_encode(['success' => true, 'message' => 'Holiday Added with Name: '.$request->get('holiday_name').' and Date:' . $request->get('holiday_date')]);
			
		} else {
			
			// DB::table('scrap_config')->insert([
			// 	'product_type' => $request->get('product_type'),
			// 	'day_of_scrap' => $request->get('day')
			// ]);
			
			// return json_encode(['success' => true, 'message' => 'Scrap configuration created successfully for product type: ' . $request->get('product_type')]);
			
		}
		
	}


	
}



