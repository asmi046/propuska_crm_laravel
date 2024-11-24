<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        {!! $content['content'] !!}

        @isset($msg)
            @if (!empty($msg))
                <strong style="background-color:rgb(255,153,0); font-weight:bold; font-size:18px">{!! $msg !!}</strong>
            @endif
        @endisset
    </body>
<html>
