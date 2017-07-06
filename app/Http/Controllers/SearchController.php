<?php

namespace App\Http\Controllers;

use App\Article;
use App\Http\Requests;
use Illuminate\Http\Request;

class SearchController extends Controller {

    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Gateway
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|alpha_num|min:2'
        ]);

        $container = $request->only(['text']);

        if (count($container['text']) <= 0 || "" == $container['text'])
            return "Nothing to search";

        /* If we have more than just a word to search */
        $keys = explode(' ', $container['text']);

        $container['results'] = $this->searchResults($keys);


        return view('pages.search', compact('container'));
    }

    /**
     * Search process.
     *
     * @param $keys
     * @return mixed
     */
    private function searchResults($keys)
    {

        return Article::whereRaw($this->combineSearchedKeys($keys, 'title')
            . ' or ' . $this->combineSearchedKeys($keys, 'body'))
            ->paginate(10);

    }

    /**
     * Construct a dynamic query.
     * @param $keys
     * @param $label
     * @return string
     */
    private function combineSearchedKeys($keys, $label)
    {

        $useFilters = '';

        $useFilters .= 'UPPER(' . $label . ') LIKE \'%';

        if (count($keys) > 1)
        {


            $useFilters .= strtoupper(implode("%' OR UPPER('" . $label . "') LIKE '%", $keys));

            $useFilters .= '%\'';

            return $useFilters;
        }

        $useFilters .= strtoupper(reset($keys));
        $useFilters .= '%\'';


        return $useFilters;
    }


}
