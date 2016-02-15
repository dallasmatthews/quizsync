@if(isset($is_create))
	{!! Form::open(['route' => ['questions.store', $quiz->id]]) !!}
@else
	{!! Form::model($question, ['route' => ['questions.update', $question->id], 'method' => 'put']) !!}
@endif				
	<div class="form-group">
		{{ Form::label('title', 'Question Title') }}
		{{ Form::text('title', null, ['class' => 'form-control input']) }}
	</div>
	<div class="form-group">
		{{ Form::label('description', 'Question Description') }}
		{{ Form::textarea('description', null, ['class' => 'form-control  input-sm', 'rows' => 4]) }}
	</div>
	<div class="row">
		<div class="form-group col-md-6">
			{{ Form::label('button_text', 'Button Text') }}
			{{ Form::text('button_text', null, ['class' => 'form-control input-sm']) }}
		</div>	
	</div>
	<hr>
	<div class="form-group">
		{{ Form::label('type', 'Question Type') }}
		{{ Form::select('type', ['multi_choice' => 'Mutiple Choice', 'short' => 'Short Answer', 'long' => 'Long Answer', 'yes_no' => 'Yes/No Answer', 'number' => 'Number Answer'], null, ['class' => 'form-control input-sm'], 'multi_choice') }}
	</div>
	@if(count($quiz->sections->lists('title')))
		<div class="form-group">
			{{ Form::label('section_id', 'Which Section?') }}
			@if(isset($is_create))
				{{ Form::select('section_id', $quiz->sections->lists('title', 'id'), count($quiz->sections->lists('title')) + 1, ['class' => 'form-control input-sm']) }}
			@else
				{{ Form::select('section_id', $quiz->sections->lists('title', 'id'), null, ['class' => 'form-control input-sm']) }}
			@endif
		</div>
	@endif
	<div class="form-group">
		{{ Form::label('order_by', 'What order?') }}
		<div class="row">
			<div class="col-sm-4">
				{{ Form::number('order_by', 0, ['class' => 'form-control input'], 0) }}
			</div>
		</div>
	</div>
	<div class="pull-right">
		{{ Form::submit($button_text, ['class' => 'btn btn-primary btn-sm']) }}
	</div>
	<div class="clearfix"></div>
{!! Form::close() !!}