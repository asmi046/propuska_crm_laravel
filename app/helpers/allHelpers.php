<?php

if (!function_exists("get_truck_addresat")) {
    function get_truck_addresat($truk) {
        $adt_tosend = config('notification_adr.adr_to_send');

        if (config('app.env') === "production") {
            $adt_tosend[] = $truk->email;
            if (!empty($truk->email_dop))
                $adt_tosend[] = $truk->email_dop;
        }
        return $adt_tosend;
    }
}

// Форматирование номера телефона

if (!function_exists("phone_format")) {
    function phone_format($phone)
    {
        $phone = trim($phone);

        $res = preg_replace(
            array(
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
                '/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
                '/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',
            ),
            array(
                '$2$3$4$5',
                '$2$3$4$5',
                '$2$3$4$5',
                '$2$3$4$5',
                '$2$3$4',
                '$2$3$4',
            ),
            $phone
        );

        return $res;
    }
}
