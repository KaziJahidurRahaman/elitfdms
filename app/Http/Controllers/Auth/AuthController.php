<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;


class AuthController extends Controller {
	
	public function index(Request $request) {
		if (Auth::check()) return redirect('/');
		return view('auth/login');
	}
	
	public function verify(Request $request) {
		$this->validate($request, [
			'login_id' => 'required',
			'password' => 'required'
		]);
		
		$login_id = $request->get('login_id');
		$password = $request->get('password');
		
		// $password = \Hash::make($password);
		// return $password;
		
		if (Auth::attempt(['login_id' => $login_id, 'password' => $password, 'status' => 1])) {
			return redirect('/');
			
		} else {
			return back()->with('error', 'Wrong login details.');
		}
	}
	

	public function checkStatus(Request $request) {
		
		if (Auth::check()) echo 'logged in';
		else echo 'logged out';
		
		
		// dd(Auth::user()->login_id);
	}
	
	
	
	public function logout(Request $request) {
		Auth::logout();
		return redirect('/auth/login');
	}
	
	
}



