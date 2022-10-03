<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;  //必要なデータをuse
use App\Genre;
use App\Tag;
use App\User;
use App\Ingredient;
use App\Process;

class RecipeListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    
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
    
    public function responce()
    {
        return \view('responce');
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
        if(!empty($data['tag'])){
            $exist_tag = Tag::where('name', $data['tag'])->first();
        }else{
            $exist_tag = Tag::where('name', $data['tag_select'])->first();
            $data['tag'] = $data['tag_select'];
        }
        //dd($exist_tag);
        if( empty($exist_tag['id']) ){
            //先にタグをインサート
            $tag_id = Tag::insertGetId(['name' => $data['tag'], 'user_id' => $data['user_id']]);
        }else{
            $tag_id = $exist_tag['id'];
        }
        //dd($tag_id);
        //タグIDをrecipesテーブルにいれる
        Recipe::where('recipe_id', $data['recipe_id'])->update(['tag_id' => $tag_id ]);
        $recipe_id = $data['recipe_id'];
        $url = $data['url'];
        // リダイレクト処理
        return view("responce", ["recipe_id" => $recipe_id, "url" => $url]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $recipe_list = Recipe::orderBy("recipe_id", "asc")->paginate(10);
        $tags = Tag::orderBy("name", "asc")->get();
        //dd($tags);
        $query = Recipe::query();

        if ($search = $request->input('search')){

            $spaceConversion = mb_convert_kana($search, 's');

            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value){
                $query->where('recipename', 'like', '%'.$value.'%');
            }

            $recipe_list = $query->paginate(10);
        }

        return \view("search", ["recipe_list" => $recipe_list, "search" => $search, "tags" => $tags]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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

    public function compare($id)
    {
        //$query = Recipe::query();
        $recipe = Recipe::where("recipe_id", $id)->first();
        
        $items = Ingredient::all()->where('recipe_id', $id)->mapToGroups(function ($item, $key) {
            return [$item->recipe_id => $item];
        })->all();

        $processes = Process::all()->where('recipe_id', $id)->mapToGroups(function ($item, $key) {
            return [$item->recipe_id => $item];
        })->all();
        //dd($processes);
        $recipe_list = Recipe::select("*")
                    ->where("tag_id", $recipe['tag_id'])
                    ->where("recipes.recipe_id", "!=", $recipe['recipe_id'])
                    ->orderByRaw("time desc, steps desc, food_items desc")
                    ->paginate(1);
        //dd($recipe_list);
        $query1 = Ingredient::all();
        $query2 = Process::all();
        foreach($recipe_list as $val) {
            $item_list = $query1->where('recipe_id', $val['recipe_id'])->mapToGroups(function ($item, $key) {
                return [$item->recipe_id => $item];
            })->all();
            $process_list = $query2->where('recipe_id', $val['recipe_id'])->mapToGroups(function ($item, $key) {
                return [$item->recipe_id => $item];
            })->all();
            
            return \view("compare", compact("recipe", "items", "processes","recipe_list", "item_list", "process_list"));
        }
        
        return \view("compare", compact("recipe", "items", "processes"));
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
