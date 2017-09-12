@extends('main')

@section('title', 'Bolg')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>Blog</h1>
        </div>
    </div>

@foreach($posts as $post)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h2>{{ $post->title }}</h2>
            <h5>Published at: {{ date('M j, Y H:i', strtotime($post->created_at)) }}</h5>

            <p>{{ substr($post->body, 0, 250) }}{{ strlen($post->body) > 250 ? "..." : "" }}</p>

            <a class="btn btn-primary" href="{{ route('blog.single', $post->slug) }}">Read More</a>
        <hr>
        </div>
    </div>
@endforeach

<div class="row">
    <div class="col-md-12">
        <div class="text-center">
            {!! $posts->links() !!}
        </div>
    </div>
</div>

@endsection