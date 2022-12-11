@extends('layouts.recipe')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-header lead d-flex bg-grad-grade text-white">似ているレシピ</div>
                <div class="card-body">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                @if (session('status'))
                                <div class="success mt-5 px-4 text-green-900">
                                    {{ session('status') }}
                                </div>
                                @endif
                                <!-- ページ固有要素 -->
                                <div>
                                    <a href='{{ $recipe2->url }}' role="button" class="shadow btn btn-outline-red btn-block text-pink" target="_blank" style="width: auto;">
                                        <h5 class="font-weight-bold pt-1">
                                            <i class="fas fa-utensils mr-2 text-secondary"></i>{{ $recipe2->recipename }}
                                        </h5>
                                    </a>
                                    <div class="card-columns">
                                        <div class="card border-white mt-3">
                                            <table class="table">
                                                <thead class="text-white">
                                                    <tr>
                                                        <td class="px-2 display-6 bg-orange">調理時間</td>
                                                        <td class="px-2 display-6 bg-orange">{{ $recipe2->time }} min</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-2 display-6 bg-orange">エネルギー</td>
                                                        <td class="px-2 display-6 bg-orange">{{ $recipe2->energy }} kal</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="px-2 display-6 bg-orange">食塩相当量</td>
                                                        <td class="px-2 display-6 bg-orange">{{ $recipe2->salt }} g</td>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                        <div class="accordion" id="accordion2">
                                            <div class="card border-danger">
                                                <button type="button" class="btn btn-block card-header text-white bg-orange" data-toggle="collapse" data-target="#process2" aria-expanded="false" aria-controls="process2">
                                                    <span class="display-6"><i class="fas fa-chevron-down mr-1"></i>手順</span>
                                                </button>
                                                <div id="process2" class="collapse" aria-labelledby="headingOne" data-parent="#accordion2">
                                                    <table class="table table-sm">
                                                        <tbody>
                                                            @foreach($processes2 as $process)
                                                            @foreach($process as $val_1)
                                                            <tr>
                                                                @if($val_1->num != 0)
                                                                <th>{{ $val_1->num }}</th>
                                                                @else
                                                                <th></th>
                                                                @endif
                                                                <td>{{ $val_1->process}}</td>
                                                                @endforeach
                                                                @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card border-danger mt-3">
                                            <div class="card-header display-6 text-white text-center bg-orange">
                                                材料・分量（{{ $recipe2->num_people }}人分）
                                            </div>
                                            <table class="table table-sm">
                                                <tbody>
                                                    @foreach($items2 as $item)
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
