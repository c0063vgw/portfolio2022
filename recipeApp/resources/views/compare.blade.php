@extends('layouts.recipe')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 p-0">
            <div class="card">
                <div class="card-header bg-pink">比較候補</div>
                    <div class="card-body">
                        <div class="py-1"></div>
                        <table class="table-auto w-full table-warning border shadow my-6">
                            <tbody>
                                @foreach($recipe_list as $val)
                                @if(!empty($val->recipe_id))
                                <tr class="border">
                                    <td class="px-3 py-2">
                                        <h5><a href='{{ $val->url }}' class="widelink text-pink font-weight-bold" target="_blank">
                                            <i class="fas fa-utensils mr-2 text-secondary"></i>{{ $val->recipename }}</a>
                                        </h5>
                                    </td>
                                    <td class="px-1 py-2">
                                        <span class="text-left"><i class="fas fa-user-friends mr-1 text-primary"></i>{{ $val->num_people }}</span>
                                        <span class="text-right"><i class="far fa-clock mr-1 lead"></i>{{ $val->time }} min</span>
                                    </td>
                                </tr>
                                @else
                                <div class="text-left">カテゴリータグを追加してください。</div>
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                        <div class="py-2 d-flex justify-content-center ">
                            {{ $recipe_list->appends(request()->input())->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
