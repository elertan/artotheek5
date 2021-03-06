@extends('app')
@section('content')
<div class="container-fluid" ng-controller="galleryController">
	@if (Auth::check() && Auth::user()->hasOnePrivelege(['Student', 'Moderator', 'Administrator']))
		<a href="{{ action('ArtworkController@create') }}" id="btnAdd" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Voeg toe</a>
		@if (Auth::check() && Auth::user()->hasOnePrivelege(['Moderator', 'Administrator']))
			<a href="{{ action('PagesController@gallery') }}" id="btnShowPublished" class="btn btn-primary">Bekijk Gepubliceerd</a>
		@endif
		<hr>
	@endif
	 <div class="col-md-4 col-xs-6 thumb artwork-container" ng-repeat="artwork in artworks">
	 	<span class="artwork-container-helper"></span>
	    <a href="/artworks/@{{ artwork.slug }}">
	    	<img src="@{{ artwork.file }}" class="img-responsive artwork-image">
	    </a>
	 </div>
</div>
<script>
	$(function () {
		app.controller('galleryController', function ($http,  $scope) {
		var request = $http.get('{{ url("/json/artworks") }}');
		request.then(function (response) {
			$scope.artworks = response.data;
		});
		@if (Auth::check() && Auth::user()->hasOnePrivelege(['Moderator', 'Administrator']))
			request = $http.get('{{ url("/json/archivedArtworks") }}');
			request.then(function (response) {
				$scope.archivedArtworks = response.data;
			});
		@endif
	});
	});
</script>
@endsection