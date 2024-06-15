<?php

namespace App\Filters;

class PassFilter extends QueryFilter {

    public function serch($serch) {
        if (!empty($serch)) {
            $mserch = "%".$serch."%";
            $this->builder->where("truc_number", "LIKE", $mserch)->orWhere("email",  "LIKE", $mserch);
        }

    }

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

}
