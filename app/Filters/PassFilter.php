<?php

namespace App\Filters;

class PassFilter extends QueryFilter {

    public function serch($serch) {
        if (!empty($serch)) {
            $mserch = "%".$serch."%";
            $this->builder->where("truc_number", "LIKE", $mserch);
            $this->builder->orWhere("email",  "LIKE", $mserch);
        }

    }

    public function sys_statuse($sys_statuse) {
        if (!empty($sys_statuse)) {

            $this->builder->whereHas('last_pass', function ($query) use ($sys_statuse) {
                $query->where('sys_status', $sys_statuse);
            });

            // if (($sys_statuse === 'Закончился')||($sys_statuse === 'Анулирован')) {
            //     $this->builder->whereHas('no_active_numbers', function ($query) use ($sys_statuse) {
            //         $query->where('sys_status', $sys_statuse);
            //     });
            // } else {
            //     $this->builder->whereHas('active_numbers', function ($query) use ($sys_statuse) {
            //         $query->where('sys_status', $sys_statuse);
            //     });

            // }

        }

    }

    public function series($series) {
        if (!empty($series)) {

            $this->builder->whereHas('last_pass', function ($query) use ($series) {
                $query->where('series', $series);
            });

            // if ((request('sys_statuse') === 'Закончился')||(request('sys_statuse') === 'Анулирован')) {
            //     $this->builder->whereHas('no_active_numbers', function ($query) use ($series) {
            //         $query->where('series', $series);
            //     });
            // } else {
            //     $this->builder->whereHas('active_numbers', function ($query) use ($series) {
            //         $query->where('series', $series);
            //     });
            // }
        }

    }

}
