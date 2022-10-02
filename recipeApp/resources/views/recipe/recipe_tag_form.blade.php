<button type="button" class="btn btn-outline-success btn-sm font-weight-bold" data-toggle="modal" data-target="#Modal{{ $recipe->recipe_id }}" data-whatever="{{ $recipe->recipename }}">
  <i class="fas fa-hashtag"></i>タグ
</button>

<div class="modal fade" id="Modal{{ $recipe->recipe_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method='POST' action="/store">
          @csrf
          <input type='hidden' name='recipe_id' value="{{ $recipe->recipe_id }}">
          <input type='hidden' name='user_id' value="{{ $user->id }}">
          <input type='hidden' name='url' value="{{ request()->fullUrl() }}">
          <div class="form-group">
            <label for="tag_select"><h6>「{{ $recipe->recipename }}」のタグを登録</h6></label>
            <select class='form-control' name='tag_select' id="tag_select">
              @foreach($tags as $tag)
              <option value="{{ $tag->name }}" {{ $tag->id == $recipe->tag_id ? "selected" : "" }}>{{$tag->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group">
            <div class="accordion" id="accordion">
              <button type="button" class="btn btn-outline-red" data-toggle="collapse" data-target="#tag_form" aria-expanded="false" aria-controls="tag_form">
                <div class="text-info font-weight-bold display-6 ml-2">
                  <i class="fas fa-chevron-down text-danger mr-1"></i>タグが見つからない場合はこちらへ入力<i class="fas fa-chevron-down ml-1 text-danger"></i>
                </div>
              </button>
              <div id="tag_form" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                <label for="tag" class="col-form-label"><h6>「{{ $recipe->recipename }}」のタグを追加</h6></label>
                <input name='tag' type="text" class="form-control" id="tag" placeholder="タグを入力">
                <div class="small">
                  ※引用元のカテゴリータグを参考にしてください。
                </div>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type='submit' class="shadow btn btn-outline-orange btn-lg">保存</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>