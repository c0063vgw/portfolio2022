<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;  //必要なデータをuse
use App\Tag;
use App\User;

class RecipeListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        //dd($data);
        // POSTされたデータをDB（memosテーブル）に挿入
        // MEMOモデルにDBへ保存する命令を出す

        //同じタグがあるか確認
        $exist_tag = Tag::where('name', $data['tag'])->first();
        //dd($is_exist);
        if( empty($exist_tag['id']) ){
            //先にタグをインサート
            $tag_id = Tag::insertGetId(['name' => $data['tag'], 'user_id' => $data['user_id']]);
        }else{
            $tag_id = $exist_tag['id'];
        }
        //dd($tag_id);
        //タグIDをrecipesテーブルにいれる
        Recipe::where('recipe_id', $data['recipe_id'])->update(['tag_id' => $tag_id ]);
        $id = $data['recipe_id'];
        // リダイレクト処理
        return redirect()->route("edit");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $recipe_list = Recipe::orderBy("recipe_id", "asc")->paginate(9);
        //$user = \Auth::user();
        $query = Recipe::query();

        if ($search = $request->input('search')){

            $spaceConversion = mb_convert_kana($search, 's');

            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value){
                $query->where('recipename', 'like', '%'.$value.'%');
            }

            $recipe_list = $query->paginate(9);
        }

        return \view("search", ["recipe_list" => $recipe_list, "search" => $search]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        return view('edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
