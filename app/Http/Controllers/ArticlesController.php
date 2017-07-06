<?php

	namespace App\Http\Controllers;

	use App\Photo;
	use Auth;
	use App\Article;
	use App\Http\Requests\ArticleRequest;
	use Illuminate\Http\Request;

	class ArticlesController extends Controller
	{
		/**
		 * ArticlesController constructor.
		 */
		public function __construct() {
			$this->middleware('auth', ["except" => ['index', 'show']]);
		}


		/**
		 * Show all published articles.
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function index() {

			$articles = Article::latest('published_at')->published()->paginate(5);

			return view('article.index', compact('articles'));
		}

		/**
		 * Show only particular article.
		 *
		 * @param Article $articles
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function show(Article $articles) {

			return view('article.show', compact('articles'));

		}

		/**
		 * Show the form to create an article.
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function create() {
			return view('article.create');
		}

		/**
		 * Create a new article.
		 * It will validate the form before even storing the data.
		 *
		 * @param ArticleRequest $request
		 *
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function store(ArticleRequest $request) {

			$input = $request->only('title', 'body', 'published_at');

			$input['user_id'] = Auth::user()->id;

			$article = Article::updateOrCreate($input);

			return redirect('articles/' . $article->id);
		}

		/**
		 * @param Article $articles
		 *
		 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
		 */
		public function edit(Article $articles) {

			return view('article.edit', compact('articles'));
		}

		/**
		 * @param ArticleRequest $request
		 *
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function update(ArticleRequest $request) {

			$input = $request->only('title', 'body', 'published_at', 'id');

			$article = Article::updateOrCreate(array('id' => $input['id']), $input);

			return redirect('articles/' . $article->id);
		}

		/**
		 * @param $articles
		 *
		 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
		 */
		public function destroy($articles) {

			$article= Article::findOrFail($articles);
			$photos = $article->photos;

			foreach($photos as $photo) {
				Photo::destroy($photo->id);
			}
			Article::findOrFail($articles)->delete();



			//return back();
			return redirect('articles');
		}


		public function addPhoto($articles,Request $request) {

			$this->validate($request,
				[
					'photo' => 'required|mimes:jpg,jpeg,png,bmp'
				]);



			$photo = Photo::fromFile($request->file('photo'));

			Article::getArticle($articles)->addPhoto($photo);



		}


	}
