<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Raleway', sans-serif;
            font-weight: 100;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        input {
            margin: 10px;
        }

        .content {
            text-align: center;
        }


    </style>
</head>
<body>
<div class="flex-center position-ref full-height">


    <div class="content">
        {!! Form::open(array('url' => '/index', 'files' => true,'method' => 'post')) !!}
        Select a picture and we will return what color predominates
        <br>
        {!! Form::file("imageToGetColor", $attributes = array()) !!}
        <br>
        {!!  Form::submit('Check Colors!') !!}
        {!! Form::close() !!}
    </div>
</div>
</body>
</html>
