<!-- Navbar -->
    <nav class="navbar navbar-inverse">
    <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Laravel Blog</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class={{ Request::is('/') ? "active": "" }}><a href="/">Home <span class="sr-only">(current)</span></a></li>
        <li class={{ Request::is('blog') ? "active": "" }}><a href="/blog">Blog</a></li>
        <li class={{ Request::is('about') ? "active": "" }}><a href="/about">About</a></li>
        <li class={{ Request::is('contact') ? "active": "" }}><a href="/contact">Contact</a></li>
      </ul>
      @if (Auth::check())
        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle" aria-hidden="true"></i> {{ Auth::user()->name }}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="{{ route('posts.index') }}">Posts</a></li>
              <li><a href="{{ route('categories.index') }}">Categories</a></li>
              <li><a href="{{ route('tags.index') }}">Tags</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ route('admin.logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
            </ul>
          </li>
        </ul>
      @endif

    </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
    </nav>
<!-- End Navbar -->
