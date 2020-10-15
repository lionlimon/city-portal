<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;
use App\Category;
use App\Status;
use Storage;

class AdminController extends Controller
{
	public function index() {
		return redirect()->route('admin.application');
	}

	public function application(Request $request) {
			
		if ($request->get('filter')) {
			$applications = Application::with('status')->orderBy('created_at', 'desc')->get(); // TODO: переделать под paginate
			switch ($request->get('filter')) {
				case 'new':
					$applications = Application::with('status')
						->new('status_id')
						->orderBy('created_at', 'desc')
						->get();
					break;
				case 'rejected':
					$applications = Application::with('status')
						->rejected('status_id')
						->orderBy('created_at', 'desc')
						->get();
					break;
				case 'resolved':
					$applications = Application::with('status')
						->resolved('status_id')
						->orderBy('created_at', 'desc')
						->get();
					break;
			}
		} else {
			$applications = Application::with('status')->orderBy('created_at', 'desc')->get(); // TODO: переделать под paginate
		}
		
		return view('admin.application', compact('applications'));
	}

	public function category() {
		$categories = Category::get(); // TODO: переделать под paginate
		return view('admin.category', compact('categories'));
	}

	public function status() {
		$statuses = Status::get(); // TODO: переделать под paginate
		return view('admin.status', compact('statuses'));
	}

	public function applicationResolve(Request $request, Application $application) {
			
		$request->validate([
			'result_img' => 'required',
		]);
		
		$filePath = 'public' . Storage::url($request->file('result_img')->store('public'));
		
		$application->result_img = $filePath;
		$application->status_id = Application::STATUS_RESOLVED;
		$application->save();
		
		return redirect()->back();
	}

	public function applicationReject(Request $request, Application $application) {
		$request->validate([
			'result_text' => 'required',
		]);

		$application->result_text = $request->input('result_text');
		$application->status_id = Application::STATUS_REJECTED;
		$application->save();
		return redirect()->back();
	}
}
								
																																																												