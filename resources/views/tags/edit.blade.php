@extends('main')

@section('title', 'Edit Tag')

@section('content')

  {{ Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) }}
      {{ Form::label('name', 'Tag:') }}
      {{ Form::text('name', null, ['class' => 'form-control']) }}
      {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-lg btn-block form-spacing-top']) }}
  {{ Form::close() }}

@endsection
