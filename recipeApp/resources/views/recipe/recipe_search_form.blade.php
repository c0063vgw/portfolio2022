<form class="w-full">
	<div class="flex flex-wrap">
		<div class="w-2/3">
            <button type="button" onclick="location.href='{{ url('/search') }}'">クリア</button>
			<input type="search" placeholder="キーワードを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
			<button class="shadow my-1 btn btn-outline-orange py-1 px-4 btn-lg" type="submit">
				検索
			</button>
		</div>
	</div>
</form>