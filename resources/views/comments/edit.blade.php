@extends('main')

@section('title', 'Edit Comments')

@section('content')

  <h1><span class="glyphicon glyphicon-edit"></span> Edit Comment</h1>

  {{ Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT']) }}
    {{ Form::label('name', 'Name:') }}
    {{ Form::text('name', null, ['class' => 'form-control' , 'disabled' => 'disabled']) }}

    {{ Form::label('email', 'Email:', ['class' => 'form-spacing-top']) }}
    {{ Form::text('email', null, ['class' => 'form-control', 'disabled' => 'disabled']) }}

    {{ Form::label('comment', 'Comment:', ['class' => 'form-spacing-top']) }}
    {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

    {{ Form::submit('Update Comment', ['class' => 'btn btn-success btn-lg btn-block form-spacing-top']) }}

  {{ Form::close() }}


@endsection
