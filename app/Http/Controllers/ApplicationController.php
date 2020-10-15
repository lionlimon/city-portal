<?php

namespace App\Http\Controllers;

use App\Application;
use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Storage;


class ApplicationController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{   
		if ($request->get('filter')) {
			$applications = Application::with('status')->orderBy('created_at', 'desc')->get(); // TODO: переделать под paginate
			switch ($request->get('filter')) {
				case 'new':
					$applications = Application::with('status')
						->where('user_id', Auth::id())
						->new('status_id')
						->orderBy('created_at', 'desc')
						->get();
					break;
				case 'rejected':
					$applications = Application::with('status')
						->rejected('status_id')
						->where('user_id', Auth::id())
						->orderBy('created_at', 'desc')
						->get();
					break;
				case 'resolved':
					$applications = Application::with('status')
						->resolved('status_id')
						->where('user_id', Auth::id())
						->orderBy('created_at', 'desc')
						->get();
					break;
			}
		} else {
			$applications = Application::with('status')->where('user_id', Auth::id())->orderBy('created_at', 'desc')->get(); // TODO: переделать под paginate
		}
		
		return view('application.index', compact('applications'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		$categories = Category::all();
		return view('application.create', compact('categories'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request)
	{		
		$request->validate([
			'name' => ['required', 'min:3'],
			'description' => ['required', 'min:10'],
			'problem_img' => ['required', 'mimes:jpg,png,jpeg', 'max:10240'],
			'category_id' => ['required'],
		]);				
		
		$imagePath = 'public/' . Storage::url($request->file('problem_img')->store('public'));

		Application::create(array_merge($request->input(), [
			'problem_img' => $imagePath, 
			'user_id' => Auth::id()
		]));		

		return redirect()->route('application.index');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Application  $application
	 * @return \Illuminate\Http\Response
	 */
	public function show(Application $application)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Application  $application
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Application $application)
	{
		$categories = Category::get();
		return view('application.edit', compact('application', 'categories'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Application  $application
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Application $application)
	{
		$request->validate([
			'name' => ['required', 'min:3'],
			'description' => ['required', 'min:10'],
			'category_id' => ['required'],
			'problem_img' => ['mimes:jpg,png,jpeg', 'max:10240'],
		]);	
		
		$extRequest = [];

		if ($request->file('problem_img')) {
			Storage::disk('public')->delete($application->prolem_img);

			$imagePath = 'public/' . Storage::url($request->file('problem_img')->store('public'));
			$extRequest = ['problem_img' => $imagePath];
		} 

		$application->update(array_merge($request->all(), $extRequest));
																								
		return redirect()->back();
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Application  $application
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Application $application)
	{
		$application->delete();
		return redirect()->back();
	}
}
