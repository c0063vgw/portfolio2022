@extends('layouts.recipe')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-0">
            <div class="card">
                @if(!@empty($recipe_list))
                <div class="card-header bg-grad-grade d-flex justify-content-center py-0">
                    <span class="text-left mt-3 ml-2 text-danger"><h5>High</h5></span>
                    <ul class="pagination pagination-sm justify-content-center">
                        {{ $recipe_list->appends(request()->input())->links() }}
                    </ul>
                    <span class="text-right mt-3 mr-2 text-indigo"><h5>Low</h5></span>
                </div>
                @else
                <div class="card-header bg-grad-grade">
                    <div class=" lead text-indigo">Dashboard</div>
                </div>
                @endif
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
                                    @if(!@empty($recipe_list))
                                    @foreach($recipe_list as $val)
                                    <a href='{{ $val->url }}' role="button" class="shadow btn btn-outline-red btn-block text-pink" target="_blank" style="width: auto;">
                                        <h5 class="font-weight-bold pt-1">
                                            <i class="fas fa-utensils mr-2 text-secondary"></i>{{ $val->recipename }}
                                        </h5>
                                    </a>
                                    @endforeach
                                    @else
                                    <div class="text-danger">比較可能なレシピがありません</div>
                                    @endif
                                    @if(!@empty($recipe_list))
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
                                        @if(!@empty($process_list))
                                        <div class="accordion" id="accordion2">
                                            <div class="card border-danger">
                                                <button type="button" class="btn btn-block card-header text-white bg-orange" data-toggle="collapse" data-target="#process2" aria-expanded="false" aria-controls="process2">
                                                    <span class="display-6"><i class="fas fa-chevron-down mr-1"></i>手順</span>
                                                </button>
                                                <div id="process2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                                                    <table class="table table-sm">
                                                        <tbody>
                                                            @foreach($process_list as $process)
                                                            @foreach($process as $val_1)
                                                            <tr>
                                                                @if($val_1->num != 0)
                                                                <th>{{ $val_1->num }}</th>
                                                                @else
                                                                <th></th>
                                                                @endif
                                                                <td>{{ $val_1->process}}</td>
                                                            </tr>
                                                            @endforeach
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if(!@empty($recipe_list))
                                        <div class="card border-danger mt-3">
                                            <div class="card-header display-6 text-white text-center bg-orange">
                                                @foreach($recipe_list as $val)
                                                    材料・分量（{{ $val->num_people }}人分）
                                                @endforeach
                                            </div>
                                            <table class="table table-sm">
                                                <tbody>
                                                    @foreach($item_list as $item)
                                                    @foreach($item as $val_2)
                                                    <tr>
                                                        <th>{{ $val_2->ingredient }}</th>
                                                        <td>{{ $val_2->quantity}}</td>
                                                    </tr>
                                                    @endforeach
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                    @endif
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
