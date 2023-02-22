<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.87.0">
    <title>Laravel</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <link href="{!! url('assets/css/dashboard.css') !!}" rel="stylesheet">
<body>
    @include('layouts.partials.header')
    <main role="main">
        <div class="container-fluid">
            <div class="row justify-content-center">
                @yield('content')
            </div>
        </div>
    </main>
</body>
</html>