<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

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
        // POSTされたデータをDB（recipesとtagsテーブル）に挿入
        // TagモデルにDBへ保存する命令を出す

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
        $recipe_list = Recipe::where('recipe_id', '!=', 10007087)->orderBy("recipe_id", "asc")->paginate(10);
        $tags = Tag::orderBy("name", "asc")->get();
        //dd($tags);
        $query = Recipe::query();

        if ($search = $request->input('search')){   //検索フォームでキーワード検索をした場合

            $spaceConversion = mb_convert_kana($search, 's');

            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);

            foreach($wordArraySearched as $value){  //キーワードをあいまい検索
                $query->where('recipename', 'like', '%'.$value.'%');
            }

            $recipe_list = $query->where('recipe_id', '!=', 10007087)->paginate(10);
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

    public function similar(Request $request, $id)
    {
        //比較元のレシピを取得
        $recipe = Recipe::where("recipe_id", $id)->first();
        
        $items = Ingredient::all()->where('recipe_id', $id)->mapToGroups(function ($item, $key) {
            return [$item->recipe_id => $item];
        })->all();

        $processes = Process::all()->where('recipe_id', $id)->mapToGroups(function ($item, $key) {
            return [$item->recipe_id => $item];
        })->all();

        //タグの一覧を取得
        $tags = Tag::orderBy("name", "asc")->get();

        $a = 0;
        //類似レシピの一覧を取得
        $recipe_list = Recipe::where('recipe_id','!=', $recipe->recipe_id)->get();

        //レーベンシュタイン距離を算出し、類似度54.5%以上のレシピと距離を配列に格納
        foreach($recipe_list as $val){
            $distance = levenshtein_normalized_utf8($recipe->recipename, $val->recipename);

            if($distance >= 0.545 && $val->recipe_id != 10007087){
                $val['distance'] = intval($distance * 100);
                $similar[$a++] = $val;
            }
        }
        //var_dump($similar);
        //dd($request->simiLevel);

        //類似レシピが存在しなければnullを返す
        if(isset($similar)){
            //難易度でソート
            $steps = array_column($similar, 'steps');           //手順数
            $food_items = array_column($similar, 'food_items'); //材料数
            $distances = array_column($similar, 'distance');    //レーベンシュタイン距離

            if($request->simiLevel == "asc"){    //昇順・降順の判定
                array_multisort($steps, SORT_DESC, $similar, $food_items, SORT_DESC, $similar, $distances, SORT_DESC, $similar);
                $similar_list = $this->paginate($similar, 10, null, ['path'=>"/similar/$recipe->recipe_id?simiLevel=asc"]);
            }else{
                array_multisort($steps, SORT_ASC, $similar, $food_items, SORT_ASC, $similar, $distances, SORT_DESC, $similar);
                $similar_list = $this->paginate($similar, 10, null, ['path'=>"/similar/$recipe->recipe_id"]);
            }
        }else
            $similar_list = null;

        //dd($similar_list);
        return \view("similar", compact("recipe", "items", "processes", "similar_list", "tags", "request"));
    }

    public function compare($id1, $id2)
    {
        //dd($id1);
        //比較元のレシピを取得
        $recipe1 = Recipe::where("recipe_id", $id1)->first();
        
        $items1 = Ingredient::all()->where('recipe_id', $id1)->mapToGroups(function ($item, $key) {
            return [$item->recipe_id => $item];
        })->all();

        $processes1 = Process::all()->where('recipe_id', $id1)->mapToGroups(function ($item, $key) {
            return [$item->recipe_id => $item];
        })->all();

        //選択されたレシピを取得
        $recipe2 = Recipe::where("recipe_id", $id2)->first();
        
        $items2 = Ingredient::all()->where('recipe_id', $id2)->mapToGroups(function ($item, $key) {
            return [$item->recipe_id => $item];
        })->all();

        $processes2 = Process::all()->where('recipe_id', $id2)->mapToGroups(function ($item, $key) {
            return [$item->recipe_id => $item];
        })->all();

        //二つのレシピをビューに返す
        return \view("compare", compact("recipe1", "items1", "processes1", "recipe2", "items2", "processes2"));
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

    //配列をページネーション
    private function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}

function levenshtein_normalized_utf8($s1, $s2, $cost_ins = 1, $cost_rep = 1, $cost_del = 1) {
    $l1 = mb_strlen($s1, 'UTF-8');
    $l2 = mb_strlen($s2, 'UTF-8');
    $size = max($l1, $l2);
    if (!$size) {
        return 0;
    }
    if (!$s1) {
        return $l2 / $size;
    }
    if (!$s2) {
        return $l1 / $size;
    }
    return 1.0 - levenshtein_utf8($s1, $s2, $cost_ins, $cost_rep, $cost_del) / $size;
}

function levenshtein_utf8($s1, $s2, $cost_ins = 1, $cost_rep = 1, $cost_del = 1) {
    $s1 = preg_split('//u', $s1, -1, PREG_SPLIT_NO_EMPTY);
    $s2 = preg_split('//u', $s2, -1, PREG_SPLIT_NO_EMPTY);
    $l1 = count($s1);
    $l2 = count($s2);
    if (!$l1) {
        return $l2 * $cost_ins;
    }
    if (!$l2) {
        return $l1 * $cost_del;
    }
    $p1 = array_fill(0, $l2 + 1, 0);
    $p2 = array_fill(0, $l2 + 1, 0);
    for ($i2 = 0; $i2 <= $l2; ++$i2) {
        $p1[$i2] = $i2 * $cost_ins;
    }
    for ($i1 = 0; $i1 < $l1; ++$i1) {
        $p2[0] = $p1[0] + $cost_ins;
        for ($i2 = 0; $i2 < $l2; ++$i2) {
            $c0 = $p1[$i2] + ($s1[$i1] === $s2[$i2] ? 0 : $cost_rep);
            $c1 = $p1[$i2 + 1] + $cost_del;
            if ($c1 < $c0) {
                $c0 = $c1;
            }
            $c2 = $p2[$i2] + $cost_ins;
            if ($c2 < $c0) {
                $c0 = $c2;
            }
            $p2[$i2 + 1] = $c0;
        }
        $tmp = $p1;
        $p1 = $p2;
        $p2 = $tmp;
    }
    return $p1[$l2];
}