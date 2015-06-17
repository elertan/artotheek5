@extends('app')
@section('content')

<div class="container-fluid">
	<div class="row">
		<div class="col-md-6">
			<div class="panel panel-default">
				<div class="panel-heading"><h2>Alle Kunstwerken met de tag: {{ $tag }}</h2></div>
				<div class="panel-body">					
					@foreach($artworks as $artwork)
					<div class="panel panel-default" >
						<div class="panel-heading">{{ $artwork->title }}</div>
						<div class="panel-body">
							<p>{!! $artwork->content !!}</p>
						</div>
						<a href="/artworks/{{ $artwork->slug }}" style="margin: 10px;" class="btn btn-success">Bekijk kunstwerk</a>
					</div>
					<img src="/{{ $artwork->file }}" alt="" style="width: 100%">
					@endforeach
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div class="panel panel-default">

				<div class="panel-heading"><h2>Alle nieuws artikelen met de tag: {{ $tag }}</h2></div>
				<div class="panel-body">					
					@foreach($articles as $article)
					<div class="panel panel-default" >
						<div class="panel-heading">{{ $article->title }}</div>
						<div class="panel-body">
							<p>{!! $article->content !!}</p>
						</div>
						<a href="/news/{{ $article->slug }}" style="margin: 10px;" class="btn btn-success">Volledig Artikel</a>
					</div>
					@endforeach
				</div>

				<div class="panel-heading"><h2>Alle Evenementen met de tag: {{ $tag }}</h2></div>
				<div class="panel-body">					
					@foreach($events as $event)
					<div class="panel panel-default" >
						<div class="panel-heading">{{ $event->title }}</div>
						<div class="panel-body">
							<p>{!! $event->content !!}</p>
						</div>
						<a href="/artworks/{{ $event->slug }}" style="margin: 10px;" class="btn btn-success">Bekijk kunstwerk</a>
					</div>
					@endforeach
				</div>
			</div>
		</div>
	</div>
</div>



@stop