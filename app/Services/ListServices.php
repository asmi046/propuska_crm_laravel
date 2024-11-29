<?php

namespace App\Services;

class ListServices {

    public function list_compare(array $base, array $list) {
        $result = [];
        foreach ($list as $item) {
            $sexist = false;
            foreach ($base as $subitem) {
                if ($subitem['truc_number'] === $item) {
                    $sexist = true;
                    break;
                }
            }
            if (!$sexist) $result[] = ['truc_number' => $item];
        }
        return $result;
    }

}
