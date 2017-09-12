@extends('main')

@section('title', 'Contact')


@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Contact Me</h1>
            <hr>
            <form action="{{ url('contact') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label name='email'>Email</label>
                    <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                </div>

                <div class="form-group">
                    <label name='subject'>Subject</label>
                    <input type="text" id="subject" name="subject" class="form-control" placeholder="subject">
                </div>

                <div class="form-group">
                    <label name='body'>Subject</label>
                    <textarea id="body" name="body" class="form-control">Type ypur message here...</textarea>
                </div>

                <div class="form-group">
                    <input class="btn btn-success" type="submit">
                </div>

            </form>
        </div>
    </div>
@endsection
