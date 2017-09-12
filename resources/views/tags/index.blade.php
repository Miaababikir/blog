@extends('main')

@section('title', 'Tags')

@section('content')

  <div class="row">
    <div class="col-md-8">
      <h1>Tags</h1>

      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tags as $tag)
            <tr>
              <th>{{ $tag->id }}</th>
              <td><a href="{{ route('tags.show', $tag->id) }}">{{ $tag->name }}</a></td>
            </tr>
          @endforeach

        </tbody>
      </table>
    </div>

    <div class="col-md-3">
      <div class="well">
        {!! Form::open(['route' => 'tags.store', 'method' => 'POST']) !!}
          <h2>New Tag</h2>
            <div class="form-group">
              {!! Form::label('name', 'Tag name: ') !!}
              {!! Form::text('name', null, ['class' => 'form-control', 'required' => ''])!!}
              {{ Form::submit('Add Tag', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top: 10px')) }}
            </div>
      </div>
    </div>

  </div>

@endsection
