<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Post And Video Upload</title>


    @include('includess.styles')
    
  </head>

  <body>

    @include('includess.nav')

      <div id='app'>
        @yield('content')
      </div>
  

   @include('includess.js') 
  </body>
</html>
