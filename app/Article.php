<?php

	namespace App;

	use Carbon\Carbon;
	use Illuminate\Database\Eloquent\Model;

	class Article extends Model
	{
		protected $fillable = [
			'title',
			'body',
			'published_at',
			'user_id'
		];

		protected $dates = ['published_at'];

		/**
		 * @param $date
		 */
		public function setPublishedAtAttribute($date) {

			$this->attributes['published_at'] = Carbon::parse($date);
		}

		/**
		 * Mutators
		 *
		 * @param $query
		 */
		public function scopePublished($query) {
			$query->where('published_at', '<=', Carbon::now());
		}

		/**
		 * @param $query
		 */
		public function scopeUnpublished($query) {
			$query->where('published_at', '>', Carbon::now());
		}

		/**
		 * @return \Illuminate\Database\Eloquent\Relations\HasMany
		 */
		public function photos() {
			return $this->hasMany('App\Photo');
		}

		/**
		 * An article belongs to a User.
		 *
		 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
		 */
		public function user(){
			return $this->belongsTo(User::class);
		}


		public static function getArticle($articles) {

			return static::where(['id'=>$articles])->firstOrFail();
		}

		/**
		 * @param Photo $photo
		 *
		 * @return Model
		 */
		public function addPhoto(Photo $photo) {
			return $this->photos()->save($photo);
		}


	}
