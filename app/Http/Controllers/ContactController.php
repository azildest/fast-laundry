<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index() {
        $contactData = Contact::all();

        return view('kontak.contactview', compact('contactData'));
    }
}