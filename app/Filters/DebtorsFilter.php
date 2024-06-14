<?php

namespace App\Filters;

class DebtorsFilter extends QueryFilter {

    public function serch($serch) {
        if (!empty($serch)) {
            $mserch = "%".$serch."%";
            $this->builder->where("truc_number", "LIKE", $mserch);
            $this->builder->orWhere("email",  "LIKE", $mserch);
        }

    }

}
