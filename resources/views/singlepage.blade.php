<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard Admin</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/font-awesome/css/all.min.css') }}" type="text/css" />
        
        
        <!-- Styles -->        
        <link rel="stylesheet" href="{{ asset('css/myskripsi.css') }}" type="text/css" >
        <link rel="stylesheet" href="{{ asset('assets/bootstrap-4.5.1/css/bootstrap.min.css') }}" type="text/css" >
        <link rel="stylesheet" href="{{ asset('assets/vue-multiselect/vue-multiselect.min.css')  }}" type="text/css">
    </head>
    <body>
        <div id="app">
            <app>
        </div>    
        
        <script src="{{ asset('assets/jquery-3.5.1/jquery-3.5.1.js') }}"></script>    
        <script src="{{ asset('assets/bootstrap-4.5.1/js/bootstrap.min.js') }} "></script>   
        <script src="{{ asset('js/app.js')}}"></script>         
        
    </body>
</html>
