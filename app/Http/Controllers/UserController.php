<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\User;
use Auth;
use View;
use Redirect;
use Input;
use Response;

class UserController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('users/create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  string  $slug
	 * @return Response
	 */
	public function show($slug)
	{
		if(Auth::check())
		{
			// Does this user exist?
			if (User::where('slug', $slug)->first()) 
			{
				// Am i this user?
				if (User::where('slug', $slug)->first()->id == Auth::user()->id) 
				{
					$user = User::where('slug',$slug)->first();
					return View::make('users/showself',compact('user'));
				} 
				else 
				{
					$user = User::where('slug',$slug)->first();
					return View::make('users/show',compact('user'));
				}
			}
			else 
			{
				return Redirect::to('/');
			}	
		}
		else
		{
			return Redirect::to('/');

		}
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  string  $slug
	 * @return Response
	 */
	public function edit($slug)
	{
		$user = User::where('slug',$slug)->first();
		return View::make('users/edit',compact('user'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($slug)
	{
		$user = User::where('slug',$slug)->first();
		$input = Input::all();

		 $user->name = Input::get('name');
		 $user->email = Input::get('email');

		$user->update();

		return Response::json([0 => 'Profiel Gewijzigd.']);
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
