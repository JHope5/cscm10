<!doctype html>
<html lang="en">
  <head>
    @include('partials._head')
  </head>

  <body>
    @include('partials._nav')
        
    <div class="container">
      <br>
      @include('partials._messages')
      @yield('content')
    </div>

    @include('partials._scripts')

    @yield('scripts')
  </body>
</html>