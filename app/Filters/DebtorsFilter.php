<?php

namespace App\Filters;

class DebtorsFilter extends QueryFilter {

    public function serch($serch) {
        if (!empty($serch)) {
            $this->builder->where("truc_number", "LIKE", "%".$serch."%");
            $this->builder->orWhere("email",  "LIKE", "%".$serch."%");
        }

    }

}
