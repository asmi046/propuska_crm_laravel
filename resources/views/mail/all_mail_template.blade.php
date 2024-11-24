<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        {!! $content['content'] !!}

        @isset($msg)
            @if (!empty($msg))
                <q>{!! $msg !!}</q>
            @endif
        @endisset
    </body>
<html>
