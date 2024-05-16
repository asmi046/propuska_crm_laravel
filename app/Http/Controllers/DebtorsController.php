<?php

namespace App\Http\Controllers;

use App\Models\Debtor;
use Illuminate\Http\Request;
use App\Filters\DebtorsFilter;

class DebtorsController extends Controller
{
    public function debtors_dashboard(DebtorsFilter $request) {
        $all_debtors = Debtor::select()->filter($request)->paginate(50);

        return view('debtors_dashboard', ['debtors' => $all_debtors]);
    }

    public function debtors_add() {
        return view('debtors_add');
    }
}
