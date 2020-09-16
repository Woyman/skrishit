<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, shrink-to-fit=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/bootstrap-4.5.2/css/bootstrap.min.css') }}">
    <script src="{{ asset('assets/jquery-3.5.1/jquery.min.js') }}"></script>

    <title>Dashboard</title>
  </head>
  <body>    
    <div id="app">
        <app></app>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('js/app.js') }}"></script>    
    <script src="{{ asset('assets/popperjs-1.16.1/popperjs.min.js') }}"></script>
    <script src="{{ asset('assets/bootstrap-4.5.2/js/bootstrap.min.js') }}"></script>
    
  </body>