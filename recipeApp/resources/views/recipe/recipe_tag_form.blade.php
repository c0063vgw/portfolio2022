<button type="button" class="btn btn-outline-success btn-sm font-weight-bold" data-toggle="modal" data-target="#Modal{{ $recipe->recipe_id }}" data-whatever="{{ $recipe->recipename }}">
  #{{ $recipe->recipe_id }}
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
          <div class="form-group">
            <label for="recipient-name" class="col-form-label"><h6>「{{ $recipe->recipename }}」のタグを追加</h6></label>
              <input name='tag' type="text" class="form-control" id="tag" placeholder="タグを入力">
                <div class="small">
                  ※引用元のカテゴリータグを参考にしてください。
                </div>
          </div>
          <div class="modal-footer">
            <button type='submit' class="btn btn-primary btn-lg">保存</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>