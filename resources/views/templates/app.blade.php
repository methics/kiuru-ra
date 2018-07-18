<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="{{asset("css/app.css")}}">

    <title>{{config("app.name", "Kiuru-RA")}}</title>

</head>
<body>
@include("inc.navbar")

<div class="container" style="margin-top: 150px;">
    @yield("content")
</div>

</body>
</html>
