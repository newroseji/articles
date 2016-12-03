<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;

class PhotosController extends Controller
{

	/**
	 * PhotosController constructor.
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	/**
	 * @param $id
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function destroy($id){
		Photo::findOrFail($id)->delete();

		return back();
	}
}
