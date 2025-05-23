<?php

namespace App\Filters;

class PassFilter extends QueryFilter {



    public function sys_statuse($sys_statuse) {
        if (!empty($sys_statuse)) {

            $this->builder->whereHas('last_pass', function ($query) use ($sys_statuse) {
                $query->where('sys_status', $sys_statuse);
            });

        }

    }

    public function series($series) {
        if (!empty($series)) {

            $this->builder->whereHas('last_pass', function ($query) use ($series) {
                $query->where('series', $series);
            });
        }

    }

    public function serch($serch) {
        if (!empty($serch)) {
            $mserch = "%".$serch."%";

            // $this->builder->where("truc_number", "LIKE", $mserch)->orWhere("email",  "LIKE", $mserch);
            $this->builder->where(function ($query) use ($mserch) {
                $query->where("truc_number", "LIKE", $mserch)
                    ->orWhere("email",  "LIKE", $mserch)
                    ->orWhere("email_dop",  "LIKE", $mserch)
                    ->orWhere("email_dop2",  "LIKE", $mserch)
                    ->orWhereHas('last_pass', function ($query_l) use ($mserch) {

                        $mseries = "";

                        if (strpos($mserch, "БА") !== false) {
                            $mseries = "БА";
                            $mserch = str_replace("БА", "", $mserch);
                        }

                        if (strpos($mserch, "ББ") !== false) {
                            $mseries = "ББ";
                            $mserch = str_replace("ББ", "", $mserch);
                        }

                        $query_l->where("pass_number", "LIKE", $mserch);
                    })->orWhereHas('active_numbers', function ($query_l) use ($mserch) {

                        $mseries = "";

                        if (strpos($mserch, "БА") !== false) {
                            $mseries = "БА";
                            $mserch = str_replace("БА", "", $mserch);
                        }

                        if (strpos($mserch, "ББ") !== false) {
                            $mseries = "ББ";
                            $mserch = str_replace("ББ", "", $mserch);
                        }

                        $query_l->where("pass_number", "LIKE", $mserch);
                    });
            });
        }

    }

}
