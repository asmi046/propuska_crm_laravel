<?php

namespace App\Services;



class TransleteratorServices {
    protected $symbols = ["А", "A", "В", "B", "Е", "E", "К", "K", "М", "M", "Н", "H", "О", "O", "Р", "P", "С", "C", "Т", "T", "У", "Y", "Х", "X"];
    protected $didgit = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
    protected $tr_replace = [
        "А" => "A", "В" => "B", "Е" => "E", "К" => "K", "М" => "M", "Н" => "H", "О" => "O", "Р" => "P", "С" => "C", "Т" => "T", "У" => "Y", "Х" => "X",
        "A" => "А", "B" => "В", "E" => "Е", "K" => "К", "M" => "М", "H" => "Н", "O" => "О", "P" => "Р", "C" => "С", "T" => "Т", "Y" => "У", "X" => "Х",
    ];

    protected $rus_to_lat = ["А" => "A", "В" => "B", "Е" => "E", "К" => "K", "М" => "M", "Н" => "H", "О" => "O", "Р" => "P", "С" => "C", "Т" => "T", "У" => "Y", "Х" => "X"];
    protected $lat_to_rus = ["A" => "А", "B" => "В", "E" => "Е", "K" => "К", "M" => "М", "H" => "Н", "O" => "О", "P" => "Р", "C" => "С", "T" => "Т", "Y" => "У", "X" => "Х"];

    protected function to_rus($number) {
        $number_ch = mb_str_split($number);
        $result = "";
        for ($i = 0; $i<count($number_ch); $i++) {
            $result .=  isset($this->lat_to_rus[$number_ch[$i]])?$this->lat_to_rus[$number_ch[$i]]:$number_ch[$i];
        }
        return $result;
    }

    protected function to_lat($number) {
        $number_ch = mb_str_split($number);
        $result = "";
        for ($i = 0; $i<count($number_ch); $i++) {
            $result .=  isset($this->rus_to_lat[$number_ch[$i]])?$this->rus_to_lat[$number_ch[$i]]:$number_ch[$i];
        }
        return $result;
    }

    protected function all_variant_translet($number) {
        $result[] = $number;
        $result[] = $this->to_rus($number);
        $result[] = $this->to_lat($number);

        $number_mass = mb_str_split($number);
        for ($i = 0; $i < count($number_mass); $i++) {
            if (in_array($number_mass[$i], $this->symbols, true))
                for ($j = 0; $j < count($number_mass); $j++)
                    if (in_array($number_mass[$j], $this->symbols, true) && ($i != $j)) {
                        $mm = $number_mass;
                        $mm[$j] = isset($this->tr_replace[$mm[$j]])?$this->tr_replace[$mm[$j]]:$mm[$j];
                        $result[] = implode($mm);
                    }
        }

        return $result;
    }


    protected function all_variant_space($number, &$all_var) {
        $i=0;
        $number_ch = mb_str_split($number);
        $symbols = ["А", "A", "В", "B", "Е", "E", "К", "K", "М", "M", "Н", "H", "О", "O", "Р", "P", "С", "C", "Т", "T", "У", "Y", "Х", "X"];
        $didgit = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9"];
        do {
            // if ((ctype_digit($number[$i]) && ctype_alpha($number[$i+1]))||(ctype_alpha($number[$i]) && ctype_digit($number[$i+1])) ) {
            if ((in_array($number_ch[$i], $didgit, true) && in_array($number_ch[$i+1], $symbols, true))||(in_array($number_ch[$i], $symbols, true) && in_array($number_ch[$i+1],  $didgit, true)) ) {
                $ns = str_replace($number_ch[$i].$number_ch[$i+1],$number_ch[$i]." ".$number_ch[$i+1],$number);
                $all_var[] = $ns;
                $this->all_variant_space($ns, $all_var);
            }

            $i++;
        } while ($i<count($number_ch)-2);

        return $all_var;
    }


    public function all_variant( $number ) {

            $result = [];

            $all_var = [];
            $all_var[] = str_replace(" ","", $number);
            $number_variant = $this->all_variant_space($number, $all_var);
            foreach($number_variant as $item) {
                $result = array_merge($this->all_variant_translet($item), $result);
            }

            return $result;
    }


}
