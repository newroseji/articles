<?php

	namespace App\Http\Controllers;

	use App\User;
	use App\Article;
	use App\Http\Requests\UserPasswordUpdateRequest;
	use App\Http\Requests\UserUpdateRequest;
	use Illuminate\Support\Facades\Auth;


	class UsersController extends Controller
	{


		/**
		 * UsersController constructor.
		 */
		public function __construct() {
			$this->middleware('auth');
		}


		/**
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function dashboard() {
			$articles = Article::where('user_id', \Auth::user()->id)->paginate(25);

			return view('user.dashboard', compact('articles'));
		}

		/**
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function profile() {

			$user = User::findOrFail(Auth::user()->id);

			return view('user.profile', compact('user'));
		}

		/**
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function edit() {


			$user = User::findOrFail(Auth::user()->id);
			return view('user.edit', compact('user'));
		}

		/**
		 * @param UserUpdateRequest $request
		 *
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update(UserUpdateRequest $request) {


			$user = User::findOrFail(Auth::user()->id);

			$user->name = $request->name;

			$user->save();

			flash()->overlay("Success!", "User updated successfully.");

			return redirect('/user/profile/');
		}

		/**
		 * @param UserPasswordUpdateRequest $request
		 *
		 * @return $this|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\Symfony\Component\HttpFoundation\Response
		 */
		public function pwUpdate(UserPasswordUpdateRequest $request) {

			$user = User::findOrFail(Auth::user()->id);

			if (! Auth::attempt(['email' => $user->email, 'password' => $request->input('old_password'), 'verified' => true])) {


				flash()->error("Sorry!", "Old password did not match.");

				//dd($user->email, $request->input('password'));
				if ($request->ajax()) {
					return response(['message' => 'Password did not match.'], 403);

				}

				return redirect('user/profile/')->withInput($request->except(['old_password']));
			}

			$user->password = bcrypt($request->input('password'));
			$user->save();

			flash()->overlay("Success!", "Password updated successfully.");

			return redirect('/user/profile/');
		}

	}
