@extends('main')

@section('title', 'Categories')

@section('content')

<div class="row">
  <div class="col-md-8">
    <h1>Categories</h1>

    <table class="table">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($categories as $category)
          <tr>
            <th>{{ $category->id }}</th>
            <td>{{ $category->name }}</td>
          </tr>
        @endforeach

      </tbody>
    </table>
  </div>

  <div class="col-md-3">
    <div class="well">
      {!! Form::open(['route' => 'categories.store', 'method' => 'POST']) !!}
        <h2>New Category</h2>
          <div class="form-group">
            {!! Form::label('name', 'Category name: ') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required' => ''])!!}
            {{ Form::submit('Add Category', array('class' => 'btn btn-primary btn-block', 'style' => 'margin-top: 10px')) }}
          </div>
    </div>
  </div>

</div>

@endsection
