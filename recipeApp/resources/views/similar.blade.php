@extends('layouts.list')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-header d-flex bg-grad-grade py-2">
                    <div class="text-white lead mt-1">似ているレシピ一覧</div>
                    <div class="lead mr-5" style="margin-left: auto"><span class="text-dark">難易度</span>
                        @if( $request->simiLevel == "asc")
                        <a class="btn btn-danger btn_sm ml-1" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                            <i class="fas fa-sort-amount-down mr-1"></i>High</a>
                        @else
                        <a class="btn btn-primary btn_sm ml-1" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                            <!--img src="{{ asset('img/sort-amount-up-alt-solid.svg') }}" class="white mr-1" width="17"--><i class="fas fa-sort-amount-up-alt"></i>Low</a>
                        @endif
                    </div>
                </div>
                    <div class="card-body p-1">
                        <div class="py-12">
                            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                                    @if (session('status'))
                                    <div class="success mt-5 px-4 text-green-900">
                                        {{ session('status') }}
                                    </div>
                                    @endif
                                    <!-- ページ固有要素 -->
                                    <form class="w-full">
                                        <div class="row">
                                            <div class="col" style="padding-right: 3em">
                                                <div class="collapse multi-collapse" id="multiCollapseExample1">
                                                <div class="card card-body float-right" style="width: 15em">
                                                    <div class="row">
                                                        <div class="col text-right mt-1" style="display: inline">難易度</div>
                                                        <div class="col checkbox-wrapper-34" style="display: inline">
                                                            <input class='tgl tgl-ios' id='toggle-34' type='checkbox' name="simiLevel" value="asc" {{ $request->simiLevel == "asc" ? 'checked' : '' }}>
                                                            <label class='tgl-btn' for='toggle-34'></label></span>
                                                        </div>
                                                    </div>
                                                    <style>
                                                        .checkbox-wrapper-34 {
                                                        --blue: #2885ff;
                                                        --g08: #ff2945;
                                                        --g04: #ffffff;
                                                        }
                                                    
                                                        .checkbox-wrapper-34 .tgl {
                                                        display: none;
                                                        }
                                                        .checkbox-wrapper-34 .tgl,
                                                        .checkbox-wrapper-34 .tgl:after,
                                                        .checkbox-wrapper-34 .tgl:before,
                                                        .checkbox-wrapper-34 .tgl *,
                                                        .checkbox-wrapper-34 .tgl *:after,
                                                        .checkbox-wrapper-34 .tgl *:before,
                                                        .checkbox-wrapper-34 .tgl + .tgl-btn {
                                                        box-sizing: border-box;
                                                        }
                                                        .checkbox-wrapper-34 .tgl::selection,
                                                        .checkbox-wrapper-34 .tgl:after::selection,
                                                        .checkbox-wrapper-34 .tgl:before::selection,
                                                        .checkbox-wrapper-34 .tgl *::selection,
                                                        .checkbox-wrapper-34 .tgl *:after::selection,
                                                        .checkbox-wrapper-34 .tgl *:before::selection,
                                                        .checkbox-wrapper-34 .tgl + .tgl-btn::selection {
                                                        background: none;
                                                        }
                                                        .checkbox-wrapper-34 .tgl + .tgl-btn {
                                                        outline: 0;
                                                        display: block;
                                                        width: 57px;
                                                        height: 27px;
                                                        position: relative;
                                                        cursor: pointer;
                                                        user-select: none;
                                                        font-size: 12px;
                                                        font-weight: 400;
                                                        color: #fff;
                                                        }
                                                        .checkbox-wrapper-34 .tgl + .tgl-btn:after,
                                                        .checkbox-wrapper-34 .tgl + .tgl-btn:before {
                                                        position: relative;
                                                        display: block;
                                                        content: "";
                                                        width: 44%;
                                                        height: 100%;
                                                        }
                                                        .checkbox-wrapper-34 .tgl + .tgl-btn:after {
                                                        left: 0;
                                                        }
                                                        .checkbox-wrapper-34 .tgl + .tgl-btn:before {
                                                        display: inline;
                                                        position: absolute;
                                                        top: 7px;
                                                        }
                                                        .checkbox-wrapper-34 .tgl:checked + .tgl-btn:after {
                                                        left: 56.5%;
                                                        }
                                                    
                                                        .checkbox-wrapper-34 .tgl-ios + .tgl-btn {
                                                        background: var(--blue);
                                                        border-radius: 20rem;
                                                        padding: 2px;
                                                        transition: all 0.4s ease;
                                                        box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.1);
                                                        }
                                                        .checkbox-wrapper-34 .tgl-ios + .tgl-btn:after {
                                                        border-radius: 2em;
                                                        background: #fff;
                                                        transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), padding 0.3s ease, margin 0.3s ease;
                                                        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.2);
                                                        }
                                                        .checkbox-wrapper-34 .tgl-ios + .tgl-btn:before {
                                                        content: "low";
                                                        left: 28px;
                                                        color: var(--g04);
                                                        transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                                                        }
                                                        .checkbox-wrapper-34 .tgl-ios + .tgl-btn:active {
                                                        box-shadow: inset 0 0 0 30px rgba(0, 0, 0, 0.1);
                                                        }
                                                        .checkbox-wrapper-34 .tgl-ios + .tgl-btn:active:after {
                                                        padding-right: 0.4em;
                                                        }
                                                        .checkbox-wrapper-34 .tgl-ios:checked + .tgl-btn {
                                                        background: var(--g08);
                                                        }
                                                        .checkbox-wrapper-34 .tgl-ios:checked + .tgl-btn:active {
                                                        box-shadow: inset 0 0 0 30px rgba(0, 0, 0, 0.1);
                                                        }
                                                        .checkbox-wrapper-34 .tgl-ios:checked + .tgl-btn:active:after {
                                                        margin-left: -0.4em;
                                                        }
                                                        .checkbox-wrapper-34 .tgl-ios:checked + .tgl-btn:before {
                                                        content: "high";
                                                        left: 4px;
                                                        color: #fff;
                                                        }
                                                    </style>
                                                    <button class="shadow my-1 btn btn-outline-orange py-1 px-3 btn-lg" type="submit">
                                                        並び替え
                                                    </button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="px-4">
                                        @if($similar_list != null)
                                        <div class="py-1"></div>
                                        <table class="table-auto w-full table-striped table-warning border shadow my-6" style="margin: auto">
                                            <tbody>
                                            @foreach($similar_list as $val)   <!--レシピ一覧を10づつレンダリング-->
                                            <tr class="border">
                                                <td class="px-3 pt-1">
                                                    <a href='{{ url("/similar/$val->recipe_id") }}' class="widelink text-pink">
                                                        <h5 class="font-weight-bold">
                                                            <i class="fas fa-utensils mr-2 text-secondary"></i>{{ $val->recipename }}
                                                        </h5>
                                                    </a>
                                                </td>
                                                <td class="px-1 py-2">
                                                    <span class="text-left"><i class="fas fa-user-friends mr-1 text-primary"></i>{{ $val->num_people }}</span>
                                                    <span class="text-right"><i class="far fa-clock mr-1 lead"></i>{{ $val->time }} min</span>
                                                </td>
                                                @auth
                                                <td class="py-2">
                                                    @include("recipe.recipe_tag_form")
                                                </td>
                                                @endauth
                                                <td class="px-3 py-2">
                                                    <!--a role="button" class="text-danger btn-lg font-weight-bold disabled" aria-disabled="true">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a-->
                                                    <a role="button" class="btn btn-outline-orange btn-sm font-weight-bold" href="{{ url("/compare/$recipe->recipe_id:$val->recipe_id") }}" target="_blank">
                                                        <!--i class="fas fa-external-link-alt"></i-->くらべる
                                                    </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="py-2 d-flex justify-content-center ">
                                            {{ $similar_list->links() }}
                                        </div>
                                        @else
                                        <div class="text-info my-1 display-5">似ているレシピは見つかりませんでした。</div>
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
    </div>
</div>
@endsection
