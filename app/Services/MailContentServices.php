<?php

namespace App\Services;
use Cache;
use App\Models\EmailTemplate;

class MailContentServices {

    public $data_fields = [
        'valid_from',
        'valid_to',
        'annul_data',
        'sts_data',
        'cancel_date'
    ];

    protected function replace_in_string(string $str, array $data) {
        $result = $str;

        foreach ($data as $key => $value) {
            if ( in_array($key, $this->data_fields) )
                $result = str_replace("[".$key."]", date("d.m.Y", strtotime($value)), $result);
            else
                $result = str_replace("[".$key."]", $value, $result);
        }

        return $result;
    }

    public function get_no_active_numbers(string $slug, array $data) {
        $result = [
            "content" => "Проблемы с шаблоном ".$slug,
            "subject" => "Проблемы с шаблоном ".$slug,
        ];

        $base_content = Cache::rememberForever('mt_'.$slug, function () use($slug) {
            $h = EmailTemplate::where("slug", $slug)->first();
            return $h;
        });

        if (!$base_content) return $result;

        $result = [
            "content" => $this->replace_in_string($base_content->text, $data),
            "subject" => $this->replace_in_string($base_content->subj, $data),
        ];

        return $result;
    }

}
