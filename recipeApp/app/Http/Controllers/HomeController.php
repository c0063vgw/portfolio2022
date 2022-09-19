<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function store(Request $request)
    {
        return redirect()->route('home');
    }

    public function show(Request $request)
    {
        $recipe_list = Recipe::orderBy("recipe_id", "asc")->paginate(9);

        $query = Recipe::query();

        if ($search = $request->input('search')){

            $spaceConversion = mb_convert_kana($search, 's');

            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value){
                $query->where('recipename', 'like', '%'.$value.'%');
            }

            $recipe_list = $query->paginate(9);
        }

        return \view("home", ["recipe_list" => $recipe_list, "search" => $search]);
    }
}
