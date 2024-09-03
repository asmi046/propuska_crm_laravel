<?php

if (!function_exists("chec_rus")) {

    function chec_rus($truc_number) {
        $is_rus = preg_match('/^[А-Я]{1}\d{3}[А-Я]{2}(\d{3}|\d{2})$/u', $truc_number);
        $is_rus2 = preg_match('/^[A-Z]{1}\d{3}[A-Z]{2}(\d{3}|\d{2})$/u', $truc_number);

        // dump( $truc_number );
        // dump( $is_rus );
        // dump( $is_rus2 );

        return (($is_rus == 1) || ($is_rus2 == 1));
    }

}

if (!function_exists("get_all_number_variant")) {
    function get_all_number_variant($number, &$all_var) {
        $i=0;
        do {
            if ((ctype_digit($number[$i]) && ctype_alpha($number[$i+1]))||(ctype_alpha($number[$i]) && ctype_digit($number[$i+1])) ) {
                $ns = str_replace($number[$i].$number[$i+1],$number[$i]." ".$number[$i+1],$number);
                $all_var[] = $ns;
                get_all_number_variant($ns, $all_var);
            }

            $i++;
        } while ($i<strlen($number)-2);

        return $all_var;
    }
}



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
