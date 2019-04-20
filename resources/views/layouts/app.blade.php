<!DOCTYPE html>
<html lang="en">
  <head>
    @include('partials.header')
    @yield('top-styles')
  </head>
  <body class="nav-md no-overflow">
      <div class="container body ">
          <div class="main_container">
                 <div id="app">


                </div>
                <!-- /contenido de la pagina -->
            </div>
        </div>
            @include('partials.footer')
       @yield('bottom-scripts')
  </body>
</html>
