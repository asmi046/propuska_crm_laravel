<?php

namespace App\Services;

use App\Models\Debtor;

class ChengeEmailServices {

    public function chenge_email_form_debtors($old_email, $new_email) {
        if (empty($old_email)) return "";

        $serched_debtors = Debtor::where('email', $old_email)->update(['email' => $new_email]);

        return ($serched_debtors)?"Замена в базе должников ".$serched_debtors." замен(ы)":"";
    }

}
