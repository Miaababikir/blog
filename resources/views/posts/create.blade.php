@extends('main')

@section('title', 'Create Posts')

@section('stylesheets')

{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}

{!! Html::script('js/tinymce.min.js') !!}

<script>
  tinymce.init({
    selector: 'textarea',
    plugins: "link code"
  });
</script>

@endsection

@section('content')

<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1>Create New Post</h1>
        <hr>

        {!! Form::open(array('route' => 'posts.store', 'files' => true)) !!}
            <div class="form-group">
            {{ Form::label('title', 'Title :') }}
            {{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255'))}}
            </div>

            <div class="form-group">
                {{ Form::label('slug', 'Slug:') }}
                {{ Form::text('slug', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255', 'minlength' => '5']) }}
            </div>

            <div class="form-group">
                {{ Form::label('category_id', 'Category:') }}
                <select name="category_id" id="category_id" class="form-control">

                    @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                {{ Form::label('tags', 'Tags:') }}
                <select name="tags[]" id="tags" class="form-control select2-multi" multiple="multiple">

                    @foreach ($tags as $tag)
                      <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach

                </select>
            </div>

            <div class="form-group">
                {{ Form::label('featured_image', 'Upload Featuerd Image:') }}
                {{ Form::file('featured_image') }}

            </div>

            <div class="form-group">
            {{ Form::label('body', 'Post Body :') }}
            {{ Form::textarea('body', null, array('class' => 'form-control'))}}
            </div>

            {{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 10px')) }}
        {!! Form::close() !!}

    </div>
</div>

@endsection

@section('scripts')

{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}

<script type="text/javascript">
  $('.select2-multi').select2();
</script>

@endsection
