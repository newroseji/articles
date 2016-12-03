<?php

	namespace App;

	use Illuminate\Foundation\Auth\User as Authenticatable;

	class User extends Authenticatable
	{
		/**
		 * The attributes that are mass assignable.
		 *
		 * @var array
		 */
		protected $fillable = [
			'name',
			'email',
			'password',
			'verified',
			'token'
		];

		/**
		 * The attributes that should be hidden for arrays.
		 *
		 * @var array
		 */
		protected $hidden = [
			'password', 'remember_token',
		];

		/*
		 * @deprecated
		 * protected function setPasswordAttribute($password) {
			$this->attributes['password'] = bcrypt($password);
		}*/

		/**
		 * Create a token while registering an user.
		 */
		public static function boot(){
			parent::boot();

			static::creating(function($user){
				$user->token=str_random(30);
			});
		}

		public function owns($relation){

			return $relation->user_id == $this->id;
		}

		/**
		 * Confirm email after registration.
		 */
		public function confirmEmail() {
			$this->verified = true;
			$this->token = null;
			$this->save();
		}

		/**
		 * A User can have many articles.
		 *
		 * @return \Illuminate\Database\Eloquent\Relations\HasMany
		 */
		protected function articles() {
			return $this->hasMany(Article::class);
		}
	}
