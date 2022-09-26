@extends('layouts.recipe')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-header bg-pink d-flex justify-content-center ">
                    <ul class="pagination pagination-sm justify-content-center">
                        {{ $recipe_list->appends(request()->input())->links() }}
                    </ul>
                </div>
                <div class="card-body">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                @if (session('status'))
                                <div class="success mt-5 px-4 text-green-900">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <!-- ページ固有要素 -->
                                <div class="pr-2">
                                    @foreach($recipe_list as $val)
                                    <a href='{{ $val->url }}' role="button" class="shadow btn btn-outline-red btn-block text-pink" target="_blank" style="width: auto;">
                                        <h5 class="font-weight-bold pt-1">
                                            <i class="fas fa-utensils mr-2 text-secondary"></i>{{ $val->recipename }}
                                        </h5>
                                    </a>
                                    @endforeach
                                    <div class="card-columns">
                                        <div class="card border-white mt-3">
                                            @foreach($recipe_list as $val)
                                            <table class="table">
                                                <thead class="text-white">
                                                    <tr>
                                                        <td class="px-2 display-6 bg-orange">調理時間</td>
                                                        <td class="px-2 display-6 bg-orange">{{ $val->time }} min</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-2 display-6 bg-orange">エネルギー</td>
                                                        <td class="px-2 display-6 bg-orange">{{ $val->energy }} kal</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-2 display-6 bg-orange">食塩相当量</td>
                                                        <td class="px-2 display-6 bg-orange">{{ $val->salt }} g</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                            @endforeach
                                        </div>
                                        <div class="card border-danger">
                                            <div class="card-header display-6 text-white bg-orange">
                                                手順
                                            </div>
                                            <tr>
                                                <th></th>
                                                <td></td>
                                            </tr>
                                        </div>
                                        <div class="card border-danger mt-3">
                                            <div class="card-header display-6 text-white bg-orange">
                                                材料・分量
                                            </div>
                                            <table class="table table-sm">
                                                <tbody>
                                                    @foreach($item_list as $item)
                                                    @foreach($item as $val)
                                                    <tr>
                                                        
                                                        <th>{{ $val->ingredient }}</th>
                                                        <td>{{ $val->quantity}}</td>
                                                        @endforeach
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                    </div>
                                </div>
                                <!-- /ページ固有要素 ここまで -->
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
