@extends('main')

@section('title', 'Edit Post')

@section('stylesheets')

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
    <!-- This type of form is to fill the form automaticly  -->
    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT', 'files' => 'true']) !!}
        <div class="col-md-8">
            <img class="thumbnail" src="{{ asset('images/' . $post->image) }}" width="750">
            {{ Form::label('title', 'Title:', ['class' => 'form-spacing-top']) }}
            {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

            {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
            {{ Form::text('slug', null, ['class' => 'form-control input-lg']) }}

            {{ Form::label('category_id', 'Categories:', ['class' => 'form-spacing-top']) }}
            {{ Form::select('category_id', $categories, null, ['class' => 'form-control']) }}

            <div class="form-group">
                {{ Form::label('tags', 'Tags:', ['class' => 'form-spacing-top']) }}
                {{ Form::select('tags[]', $tags, null, ['class' => 'form-control select2-multi', 'multiple' => 'multiple']) }}
            </div>

            {{ Form::label('featured_image', 'Update Featured Image') }}
            {{ Form::file('featured_image') }}

            {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
            {{ Form::textarea('body', null, ['class' => 'form-control']) }}
        </div>

        <div class="col-md-4">
            <div class="well">
                <dl class="dl-horizontal">
                  <dt>Created At:</dt>
                  <dd>{{ date('M j, Y H:i', strtotime($post->created_at)) }}</dd>

                  <dt>Last Updated:</dt>
                  <dd>{{ date('M j, Y H:i', strtotime($post->updated_at)) }}</dd>
                </dl>

                <hr>

                <div class="row">

                    <div class="col-sm-6">
                        {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class' => 'btn btn-danger btn-block')) !!}
                    </div>

                    <div class="col-sm-6">
                        {{ Form::submit('Save Changes', ['class' => 'btn btn-success btn-block']) }}
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}

</div>

@endsection

@section('scripts')

{!! Html::script('js/select2.min.js') !!}

<script type="text/javascript">
  $('.select2-multi').select2();
</script>

@endsection
