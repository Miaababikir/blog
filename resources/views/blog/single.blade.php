@extends('main')

@section('title', "$post->title")

@section('content')
    <div class="row">
        <div class="col-md-offset-2 col-md-8">
            <img class="thumbnail" src="{{ asset('images/' . $post->image) }}" alt="">
            <h1>{{ $post->title }}</h1>
            <p class="lead">{!! $post->body !!}</p>
            <hr>
            <p>Posted On: {{ $post->category->name }}</p>
        </div>
    </div>

    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        <h3 class="comment-title"><span class="glyphicon glyphicon-comment"></span> {{ $post->comments()->count() }} Comments</h3>
        @foreach ($post->comments as $comment)
          <div class="comment f orm-spacing-top">
            <div class="author-info">
              <img class="author-image" src="{{ 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($comment->email))) . '?s=50&d=mm' }}">
              <div class="author-name">
                <h4>{{ $comment->name }}</h4>
                <p class="author-time">{{ date('M j, Y H:i', strtotime($comment->created_at)) }}</p>
              </div>
            </div>

            <div class="comment-content">
              {{ $comment->comment }}
            </div>
          </div>
        @endforeach
      </div>
    </div>

    <div class="row">
      <div id="comment-form" class="col-md-offset-2 col-md-8">
        {{ Form::open(['route' => ['comments.store', $post->id], 'method' => 'POST']) }}
          <div class="row">
            <div class="col-md-6">
              {{ Form::label('name', 'Name:') }}
              {{ Form::text('name', null, ['class' => 'form-control']) }}
            </div>

            <div class="col-md-6">
              {{ Form::label('email', 'Email:') }}
              {{ Form::text('email', null, ['class' => 'form-control']) }}
            </div>

            <div class="col-md-12 form-spacing-top">
              {{ Form::label('comment', 'Comment:') }}
              {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}

              {{ Form::submit('Add Comment', ['class' => 'btn btn-success btn-block form-spacing-top']) }}
            </div>
          </div>
        {{ Form::close() }}
      </div>
    </div>
@endsection
