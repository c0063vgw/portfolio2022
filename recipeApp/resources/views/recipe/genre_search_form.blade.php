<div class="accordion" id="accordion3">
	<button type="button" class="btn btn-link" data-toggle="collapse" data-target="#genre" aria-expanded="false" aria-controls="genre">
		<span class="display-6"><i class="fas fa-chevron-down mr-1"></i>すべて表示</span>
	</button>
	<div id="genre" class="collapse" aria-labelledby="headingOne" data-parent="#accordion3">
	@foreach($genre_list as $genre)
	<a type="button" class="btn btn-link btn-sm" href="{{ url("/search?search=$genre->name") }}">{{ $genre->name }}</a>
	@endforeach
	</div>
</div>