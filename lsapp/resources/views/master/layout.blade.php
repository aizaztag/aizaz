<html>
<head>
    <title>App Name - @yield('title')</title>
</head>
<body>
@section('sidebar')
    This is the master sidebar.

@show

<div class="container">

    @yield('content', 'Default Content')
</div>
</body>
</html>