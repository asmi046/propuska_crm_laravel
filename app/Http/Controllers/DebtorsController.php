<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DebtorsController extends Controller
{
    public function debtors_dashboard() {
        return view('debtors_dashboard');
    }

    public function debtors_add() {
        return view('debtors_add');
    }
}
