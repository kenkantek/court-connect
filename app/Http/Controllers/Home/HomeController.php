<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;

class HomeController extends Controller {

	public function getIndex() {
		return view('home.index');
	}

	public function showSignUp() {
		return view('home.signup');
	}

	public function postSignUp() {
		return view('home.signup');
	}

	public function showAccount() {
		return view('home.account');
	}

	public function updateAccount() {
		return view('home.account');
	}

	public function showCheckout() {
		return view('home.checkout');
	}

	public function postCheckout() {
		return view('home.checkout');
	}

}
