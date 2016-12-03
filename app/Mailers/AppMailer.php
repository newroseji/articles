<?php

namespace App\Mailers;

	use App\User;
	use Illuminate\Mail\Mailer;

	class AppMailer
	{

		protected $from = 'admin@example.com';
		protected $to;
		protected $view;
		protected $data = [];
		private $mailer;

		/**
		 * AppMailer constructor.
		 *
		 * @param $mailer
		 */
		public function __construct(Mailer $mailer) {
			$this->mailer = $mailer;
		}

		/**
		 * @param User $user
		 */
		public function sendEmailConfirmationTo(User $user) {
			$this->to = $user->email;
			$this->view = 'emails.confirm';
			$this->data = compact('user');

			$this->deliver();
		}

		/**
		 * Deliver email
		 */
		public function deliver() {
			$this->mailer->send(
				$this->view,
				$this->data,
				function ($message) {
					$message->from($this->from, 'doNotReply')
						->subject("Email Confirmation required!")
						->to($this->to);
				}
			);
		}


	}