<!DOCTYPE html>
<html lang="ru">
    <head>
        <meta charset="utf-8">
    </head>

    <body>
        <p>Здравствуйте, пропуск на {{ $pass['truck_num'] }}  заканчивается {{ date("d.m.Y", strtotime($pass['valid_to'])) }} Для повторного продления свяжитесь с нами по почте <a href="mailto:zakaz@propuska-mkad-ttk-sk.ru">zakaz@propuska-mkad-ttk-sk.ru</a> или по телефонам:</p>
        <p><a href="tel:+74994042119">+7 (499) 404-21-19</a></p>
        <p><a href="tel:+79160065277">+7 (916) 006-52-77</a></p>
        <p>Серия и номер пропуска {{ $pass['series'] }} {{ $pass['pass_number'] }} ({{ $pass['type_pass'] }})</p>
        <br/>
        <br/>
        <p>Вы получили это письмо так как для вашего номера подключены уведомления, если вы хотите отказаться от уведомлений нажмите <a href = '#'>отписаться от уведомлений</a> но тогда в случае аннуляции Вашего пропуска, уведомление к вам не придет.</p>
    </body>
<html>
