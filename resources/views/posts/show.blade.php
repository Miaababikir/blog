@extends('main')

@section('title', 'View Posts')

@section('content')

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $post->title }}</h1>
            <p class="lead">{!! $post->body !!}</p>

            <hr>

            <div class="tags">
                @foreach ($post->tags as $tag)
                    <span class="label label-default">{{ $tag->name }}</span>
                @endforeach
            </div>

            <div id="backend-comments">
              <h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>

              <table class="table">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Comments</th>
                    <th width="150px"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($post->comments as $comment)
                    <tr>
                      <td>{{ $comment->name }}</td>
                      <td>{{ $comment->email }}</td>
                      <td>{{ $comment->comment }}</td>
                      <td>
                        <a class="btn btn-sm btn-default" href="{{ route('comments.edit', $comment->id) }}"><span class="glyphicon glyphicon-edit"></span> Edit</a>
                        <a class="btn btn-sm btn-danger" href="{{ route('comments.delete', $comment->id) }}"><span class="glyphicon glyphicon-remove"></span> Delete</a>
                      </td>
                    </tr>

                  @endforeach
                </tbody>

              </table>
            </div>

        </div>

        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                  <label>Url:</label>
                  <p><a href="{{ url('blog/'.$post->slug) }}">{{ url('blog/'.$post->slug) }}</a></p>
                </dl>

                <dl class="dl-horizontal">
                  <label>Category:</label>
                  <p>{{ $post->category->name }}</p>
                </dl>

                <dl class="dl-horizontal">
                  <label>Created At:</label>
                  <p>{{ date('M j, Y H:i', strtotime($post->created_at)) }}</p>
                </dl>

                <dl class="dl-horizontal">
                  <label>Last Updated:</label>
                  <p>{{ date('M j, Y H:i', strtotime($post->updated_at)) }}</p>
                </dl>

                <hr>

                <div class="row">

                    <div class="col-sm-6">
                        {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE']) !!}

                            {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) }}

                        {!! Form::close() !!}
                    </div>

                    <div class="col-sm-6">

                        {!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' => 'btn btn-primary btn-block')) !!}

                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">
                        <a href="{{ route('posts.index') }}" class="btn btn-default btn-block form-spacing-top"><< See All Posts</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
