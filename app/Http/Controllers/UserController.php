<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {

	public function pageProfile(User $user) {
		return view('pages.user.profile', compact('user'));
	}
}
