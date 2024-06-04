
<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
    </head>

    <body>
        <p>Здравствуйте, {{ $pass['truck_num'] }} - вышел разовый пропуск на {{ $pass['pass_zone'] }} с {{ date("d.m.Y", strtotime($pass['valid_from'])) }} по {{ date("d.m.Y", strtotime($pass['valid_to'])) }} включительно.  Серия и номер пропуска {{ $pass['series'] }} {{ $pass['pass_number'] }} ({{ $pass['type_pass'] }})</p>
        <br/>
        <br/>
        <p>Вы получили это письмо так как для вашего номера подключены уведомления, если вы хотите отказаться от уведомлений нажмите <a href = '#'>отписаться от уведомлений</a> но тогда в случае аннуляции Вашего пропуска, уведомление к вам не придет.</p>
    </body>
<html>
