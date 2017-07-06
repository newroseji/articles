<?php

	namespace App\Http\Controllers\Auth;

	use App\Http\Requests\UserRequest;
	use App\Mailers\AppMailer;
	use App\User;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Validator;
	use App\Http\Controllers\Controller;
	use Illuminate\Foundation\Auth\ThrottlesLogins;
	use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

	class AuthController extends Controller
	{
		/*
		|--------------------------------------------------------------------------
		| Registration & Login Controller
		|--------------------------------------------------------------------------
		|
		| This controller handles the registration of new users, as well as the
		| authentication of existing users. By default, this controller uses
		| a simple trait to add these behaviors. Why don't you explore it?
		|
		*/

		use AuthenticatesAndRegistersUsers, ThrottlesLogins;

		/**
		 * Where to redirect users after login / registration.
		 *
		 * @var string
		 */
		protected $redirectTo = '/articles';


		/**
		 * AuthController constructor.
		 */
		public function __construct() {
			$this->middleware([$this->guestMiddleware(),'throttle:3,1'], ['except' => 'logout']);
		}


		/**
		 * @param UserRequest $request
		 * @param AppMailer   $mailer
		 *
		 * @return \Illuminate\Http\RedirectResponse
		 */
		public function register(UserRequest $request, AppMailer $mailer) {


			$user = User::updateOrCreate([
					'name' => $request->input('name'),
					'email'    => $request->input('email'),
					'password' => bcrypt($request->input('password'))
				]
			);

			// email them a confirmation link
			$mailer->sendEmailConfirmationTo($user);

			// flashes message
			flash()->overlay("Registered!", "Now, please confirm your " . $user->email);

			// redirect to login
			return back();

		}

		/**
		 * @param $token
		 *
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function confirmEmail($token) {

			User::whereToken($token)->firstOrFail()->confirmEmail();

			flash()->success("Wala!", "You are now confirmed. Please login.");

			return redirect('login');
		}

		/**
		 * @param Request $request
		 *
		 * @return $this|\Illuminate\Http\RedirectResponse
		 */
		public function login(Request $request) {

			$this->validate($request,
				[
					'email'    => 'required|email',
					'password' => 'required'
				]);

			// attempt to login you in
			if (Auth::attempt($this->getCredentials($request))) {

				return redirect()->intended('/articles');
			}

			flash()->error("Oops!", "Could not sign you in.");

			return redirect('login')->withInput($request->except('password'));

		}

		/**
		 * @param Request $request
		 *
		 * @return array
		 */
		public function getCredentials(Request $request) {
			return [
				'email'    => $request->input('email'),
				'password' => $request->input('password'),
				'verified' => true
			];
		}

		/**
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function logout() {
			Auth::logout();


			flash()->success("See ya!", "You have now been signed out.");

			return redirect('login');
		}
	}
