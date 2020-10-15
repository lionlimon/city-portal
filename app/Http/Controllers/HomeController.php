<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\User;

class HomeController extends Controller
{
	public function index() {
		$applications = Application::resolved()
			->limit(8)
			->orderBy('created_at', 'desc')
			->get();

		$resolvedCount = Application::resolved()->count();
		$usersCount = User::count();

		return view('home', compact('applications', 'resolvedCount', 'usersCount'));
	}

	public function counters() {
		$resolvedCount = Application::resolved()->count();
		$usersCount = User::count();
		return response()->json(compact('resolvedCount', 'usersCount'));
	}
}

