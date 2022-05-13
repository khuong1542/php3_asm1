<!doctype html>
<!--[if lte IE 9]>
<html lang="en" class="oldie">
<![endif]-->
<!--[if gt IE 9]><!-->
<html lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Page Error 403 </title>
    <link rel="stylesheet" media="all" href="{{asset('error403')}}/style.css" />
</head>

<body>
    <div id="clouds">
        <div class="cloud x1"></div>
        <div class="cloud x1_5"></div>
        <div class="cloud x2"></div>
        <div class="cloud x3"></div>
        <div class="cloud x4"></div>
        <div class="cloud x5"></div>
    </div>
    <div class='c'>
        <div class='_403'>404</div>
        <hr>
        <div class='_1'>you're not permItted to see this.</div>
        <div class='_2'>
            <p> The page you're trying to access has restricted access. </p>
            <p>If you feel this is mistake, contact your admin</p>
        </div>
        @if(Auth::check())
        <a class='btn' href="{{route('dashboard')}}">Return Home</a>
        @else
        <a class='btn' href="{{route('welcome')}}">Return Home</a>
        @endif
    </div>
</body>

</html>