@extends('main')

@section('title', 'Home')


@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="jumbotron">
            <h1>Welcom to My Blog</h1>
              <p class="lead">Thanck you for visiting my website. Check my popural postes</p>
              <p><a class="btn btn-primary btn-lg" href="#" role="button">Popural posts</a></p>
        </div>
    </div>
</div><!-- End of row -->

<div class="row">

    <div class="col-md-8">

            @foreach($posts as $post)

                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p>{{ strip_tags($post->body) }}</p>
                    <a href= "{{ url('blog/'.$post->slug) }}" class="btn btn-primary">Read More</a>
                </div>
                    <hr>

            @endforeach

    </div>



    <div class="col-md-3 col-md-offset-1">
        <h2>Sidebar</h2>
    </div>
</div>

<div class="text-center">
            {!! $posts->links(); !!}
</div>

@endsection
