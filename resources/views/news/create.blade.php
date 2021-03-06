@extends('app')
@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Nieuw artikel</div>
				<div class="panel-body">

					{!! Form::open(['class' => 'form-horizontal', 'id' => 'form']) !!}
						<div class="form-group">
							{!! Form::label('Titel', null, ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::text('title', null, ['class' => 'form-control', 'id' => 'tbx-title']) !!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('Inhoud', null, ['class' => 'control-label col-md-1']) !!}
							<div class="col-md-12">
								{!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'textarea-content']) !!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('Publiceer', null, ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								{!! Form::checkbox('publish', true, ['class' => 'col-md-4 form-control','id' => 'publish' ]) !!}
							</div>
						</div>
						<div class="form-group">
							{!! Form::label('Tags', null, ['class' => 'col-md-4 control-label']) !!}
							<div class="col-md-6">
								<input id="tbx-tags" type="text" class="form-control" value="" placeholder="Voeg tags toe..." data-role="tagsinput">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								{!! Form::submit('Verstuur', ['class' => 'btn btn-success form-control', 'id' => 'btn-send']) !!}
							</div>
						</div>
					{!! Form::close() !!}

				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(function () {
		var editor = CKEDITOR.replace('textarea-content');
		$('#form').submit(function (event) { 
			event.preventDefault(); 
			
			var request = $.post('/news', {
				_method: 'POST',
				_token: '{{ csrf_token() }}',
				title: $('#tbx-title').val(),
				content: editor.getData(),
				tags: $('#tbx-tags').val(),
				state:$('#publish').val()
			});

			request.success(function (response) {
				var successMsg = '<ul>';
				for (var key in response) {
					if (response.hasOwnProperty(key)) {
						var msg = response[key];
						successMsg += '<li>' + msg + '</li>';
					}
				}
				successMsg += '</ul>';
				functions.showSuccessBanner(successMsg, 5000);
			});

			request.progress(function () {

			});

			request.error(function () {
				var response = request.responseJSON;

				var errorMsg = '<ul>';
				for (var key in response) {
					if (response.hasOwnProperty(key)) {
						var item = response[key];
						errorMsg += '<li>' + item + '</li>';
					}
				}
				errorMsg += '</ul>';
				functions.showErrorBanner(errorMsg, 5000);
			});

		});
	});
</script>
@stop