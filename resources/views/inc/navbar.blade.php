<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-static-top">
  <a class="navbar-brand" href="/">{{ config('app.name') }}</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/posts">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/project">Project</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about">About</a>
      </li>
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
          @if (Route::has('login'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
          @endif
          
          @if (Route::has('register'))
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @endif
      @else

          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  {{ Auth::user()->name }}
              </a>
              

              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                @if (auth()->user()->role == 'admin')
                  <a class="dropdown-item" href="/admin">Admin dashboard</a>
                @else
                    
                @endif
                  
                  <a class="dropdown-item" href="/dashboard">Dashboard</a>
                  <a class="dropdown-item" href="/posts/create">Create post</a>

                  <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>

                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                      @csrf
                      
                  </form>

              </div>
          </li>
      @endguest
  </ul>
  </div>
</nav>

<script>
  $(function($) {
    let url = window.location.href;
    $('li a').each(function() {
      if (this.href === url) {
        $(this).closest('li').addClass('active');
      }
      console.log(url);
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#myModal').modal('show');
  });
</script>
<script>
  function goBack() {
    window.history.back();
  }
</script>