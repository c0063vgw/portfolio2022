<form class="w-full">
	<div class="flex flex-wrap">
		<div class="w-2/3">
            <button type="button" onclick="location.href='{{ url('/search') }}'">クリア</button>
			<input type="search" placeholder="キーワードを入力" name="search" value="@if (isset($search)) {{ $search }} @endif">
			<button class="shadow my-3 bg-blue-500 btn btn-outline-danger font-bold py-2 px-4 rounded" type="submit">
				検索
			</button>
		</div>
	</div>
</form>