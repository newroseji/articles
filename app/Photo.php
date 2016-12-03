<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;
	use Illuminate\Http\UploadedFile;


	class Photo extends Model
	{

		protected $table = 'article_photos';

		protected $fillable = ['name', 'thumbnail_path', 'photo_path', 'caption'];

		protected $file;
		protected static $filename;
		protected static $thumbnailnamePath;

		/**
		 * Boot
		 */
		protected static function boot() {
			static::creating(function ($photo) {
				return $photo->upload();
			});
		}

		/**
		 * Photo's relationship to Flyer model.
		 *
		 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
		 */
		public function flyer() {
			return $this->belongsTo('App\Flyer');
		}

		public static function fromFile(UploadedFile $file) {
			$photo = new static;

			$photo->file = $file;
			self::$filename= $photo->fileName();
			self::$thumbnailnamePath = $photo->thumbnailPath();

			return $photo->fill([
				'name'           => self::$filename,
				'caption'        => $photo->fileCaption(),
				'photo_path'     => $photo->filePath(),
				'thumbnail_path' => self::$thumbnailnamePath
			]);
		}

		/**
		 * @return string
		 */
		public function fileCaption() {
			return strtok($this->file->getClientOriginalName(), '.');
		}

		/**
		 * @return string
		 */
		public function fileName() {
			$name = sha1(
				time() . $this->file->getClientOriginalName()
			);

			$extension = $this->file->getClientOriginalExtension();

			return "{$name}.{$extension}";
		}

		/**
		 * @return string
		 */
		public function filePath() {
			return $this->baseDir() . '/' . $this->fileName();
		}

		/**
		 * @return string
		 */
		public function thumbnailPath() {
			return $this->baseDir() . '/tn-' . $this->fileName();
		}

		/**
		 * @return string
		 */
		public function baseDir() {
			return 'images/photos';
		}

		/**
		 * @return $this
		 */
		public function upload() {
			$this->file->move($this->baseDir(), self::$filename);

			$this->makeThumbnail();

			return $this;
		}


		/**
		 * Make a Thumbnail
		 */
		protected function makeThumbnail() {
			\Image::make($this->filePath())
				->fit(200)
				->save(self::$thumbnailnamePath);
		}

		public function delete() {
			\File::delete([
				$this->photo_path,
				$this->thumbnail_path
			]);

			parent::delete();
		}


	}
