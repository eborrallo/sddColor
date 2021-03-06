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
    <link href="/css/index.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="flex-center position-ref full-height">

    <?php
    if (isset($colors->hexarray)) {

        $color = array_keys($colors->hexarray);
    $colorVal = array_values($colors->hexarray);
    ?>
    <table border="1">
        @if (isset($colors->error))
            <tr>
                <th colspan="3" height="100" width="100">
                    <img height="100" width="100" src="{{ $colors->imagePath}}">
                </th>
            </tr>
            <tr>
                <th colspan="3">
                    {{$colors->error}}
                </th>

            </tr>
        @else
            <tr>
                <th colspan="3" height="100" width="100" bgcolor="{{ $color[0]}}">
                    <img height="100" width="100" src="{{ $colors->imagePath}}">
                </th>
            </tr>
            <tr>
                <th colspan="3" bgcolor="{!! $color[0]!!}">
                    I'm filled with the image color type
                    <br>
                    The winner color is : {{array_search($color[0],$colors->COLORS)}} ({{$color[0]}})

                </th>

            </tr>
        @endif
        <tr>
            <td>Color</td>
            <td>Count</td>
            <td>Color value</td>
        </tr>


        @for ($i = 0; $i <= count($color) - 1; $i++)
            <tr>
                <td bgcolor={{$color[$i]}}   width=16 height=16></td>
                &nbsp;
                <td>  {{intval($colors->hexarray[$color[$i]] - 1)}}</td>
                <td>{{$color[$i]}}</td>
            </tr>


        @endfor
        <?php }?>

    </table>
    <div class="content">
        {!! Form::open(array('url' => '/', 'files' => true,'method' => 'post')) !!}
        Select a picture and we will return what color predominates
        <br>
        This is a calculation of pixel by pixel, if you give us a very large image it will take a long time to process it, I recommend images 500x500, or 600x600, try not to exceed 1000x1000 if you do not want to wait a long time
        <br>
        {!! Form::file("imageToGetColor", $attributes = array()) !!}
        <br>
        {!!  Form::submit('Check Colors!') !!}
        {!! Form::close() !!}
    </div>
</div>
</body>
</html>
