<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

   

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" type="text/css" href="{{url('bootstrap/css/bootstrap.min.css')}}">
    <style>
        .dropbtn {
          background-color: #4CAF50;
          color: white;
          padding: 16px;
          font-size: 16px;
          border: none;
          cursor: pointer;
        }
        
        .dropdown {
          position: relative;
          display: inline-block;
        }
        
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }
        
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        
        .dropdown-content a:hover {background-color: #f1f1f1}
        
        .dropdown:hover .dropdown-content {
          display: block;
        }
        
        .dropdown:hover .dropbtn {
          background-color: #3e8e41;
        }
        </style>
</head>
<body>
    <div id="app">
       
        <main class="py-4">
            @include('inc.navbar')
            <div class="container">
                @include('inc.messages')
            @yield('content')
            <script src="{{ url('ckeditor/ckeditor.js') }}"></script>
        <script>
        CKEDITOR.replace( 'summary-ckeditor' );
        </script>
            <div>
        </main>
    </div>

     <!-- Scripts -->
     <script src="{{ url('bootstrap/js/bootstrap.bundle.min.css') }}"></script>
</body>
</html>
