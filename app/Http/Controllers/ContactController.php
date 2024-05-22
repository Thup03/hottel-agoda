<?php

namespace App\Http\Controllers;
use App\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('contact.contacts_list', ['contacts' => $contacts]);
    }

    public function destroy($id)
    {
        Contact::findOrFail($id)->delete();
    }
}
