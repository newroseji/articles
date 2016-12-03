<?php

	namespace App\Http\Requests;

	use App\Http\Requests\Request;

	class UserPasswordUpdateRequest extends Request
	{
		/**
		 * Determine if the user is authorized to make this request.
		 *
		 * @return bool
		 */
		public function authorize() {
			return true;
		}

		/**
		 * Get the validation rules that apply to the request.
		 *
		 * @return array
		 */
		public function rules() {
			return [
				'old_password'          => 'required|min:6|max:50',
				'password'              => 'required|min:6|max:50|confirmed',
				'password_confirmation' => 'required|min:6|max:50'
			];
		}
	}
