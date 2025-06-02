<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index() {
        $accountData = Account::all();

        return view('akun.accountview', compact('accountData'));
    }
}
