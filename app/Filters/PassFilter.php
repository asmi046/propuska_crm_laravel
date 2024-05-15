<?php

namespace App\Filters;

class PassFilter extends QueryFilter {

    public function serch($serch) {
        if (!empty($serch)) {
            $this->builder->where("truc_number", "LIKE", "%".$serch."%");
            $this->builder->orWhere("email",  "LIKE", "%".$serch."%");
        }

    }

    public function sys_statuse($sys_statuse) {
        if (!empty($sys_statuse)) {


            if (($sys_statuse === 'Закончился')||($sys_statuse === 'Анулирован')) {
                $this->builder->whereHas('no_active_numbers', function ($query) use ($sys_statuse) {
                    $query->where('sys_status', $sys_statuse);
                });
            } else {
                $this->builder->whereHas('active_numbers', function ($query) use ($sys_statuse) {
                    $query->where('sys_status', $sys_statuse);
                });

            }

        }

    }

    public function series($series) {
        if (!empty($series)) {

            if ((request('sys_statuse') === 'Закончился')||(request('sys_statuse') === 'Анулирован')) {
                $this->builder->whereHas('no_active_numbers', function ($query) use ($series) {
                    $query->where('series', $series);
                });
            } else {
                $this->builder->whereHas('active_numbers', function ($query) use ($series) {
                    $query->where('series', $series);
                });
            }




        }

    }

}
