<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Requests\PlayerRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Models\Player;
use App\Models\Deal;
use Hash;

class HomeController extends Controller {

	public function getIndex() {
		return view('home.index');
	}

	public function getSsearch() {
		return view('home.search');
	}

	public function getSignUp() {
		return view('home.signup');
	}

	public function postSignUp(PlayerRequest $request) {	
		$user = new User();
		$user->first_name = $request->firstname;
		$user->last_name = $request->lastname;
		$user->email = $request->email;
		$user->password = Hash::make($request->password);
		$user->remember_token = $request->_token;
		$user->fullname = $request->firstname." ".$request->lastname;
		$user->save();

		$user_id = $user->id;	

		$player = new Player();
		$player->user_id = $user_id;	
		$player->receive_discount_offers = $request->cb_offers;
		$player->is_recive_notification	 = 1;
		$player->save();

		return view('home.index');
	}

	public function getAccount($id) {
		$booking = Deal::where('user_id', $id)->get()->toArray();
		return view('home.account', compact('booking'));
	}

	public function updateSettingPassword(Request $request, $id) {
		$user = User::find($id);		
		if(!Hash::check($request->old_password, $user->password)){
			return back()->withInput()->with(['flash_level'=>'danger', 'flash_message'=>'Old Password Is Not Correct']);
		}elseif($request->password != $request->cfrpassword){			
			return back()->withInput()->with(['flash_level'=>'danger', 'flash_message'=>'Password Is Not Match']);
		}else{
			if($request->password == ""){
				return back()->withInput()->with(['flash_level'=>'danger', 'flash_message'=>'Please Enter New Password']);
			}else{
				$user->password = Hash::make($request->password);
				$user->save();
				return back()->withInput()->with(['flash_level'=>'success', 'flash_message'=>'Success! Complete Update Password!']);
			}
			
		}		
	}

	public function updateSettingContact(Request $request, $id) {
		$user = User::find($id);
		$user->email = $request->email;
		$user->phone = $request->phone;
		$user->save();
		return back()->withInput()->with(['flash_level'=>'success', 'flash_message'=>'Success! Complete Update Contact!']);
	}

	public function updateSettingAddress(Request $request, $id) {
		$user = Player::find($id);
		$user->zipcode 	= $request->zipcode;
		$user->address1 = $request->address1;
		$user->address2 = $request->address2;
		$user->city 	= $request->city;
		$user->state 	= $request->state;
		$user->save();
		return back()->withInput()->with(['flash_level'=>'success', 'flash_message'=>'Success! Complete Update Address!']);
	}

	public function showSearch() {
		return view('home.search');
	}

	public function postSearch() {
		return view('home.search');
	}

	public function showCheckout() {
		return view('home.checkout');
	}

	public function postCheckout() {
		return view('home.checkout');
	}

}
