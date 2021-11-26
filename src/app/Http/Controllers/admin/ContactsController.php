<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Contact;
use App\User;

class ContactsController extends Controller
{
    public function index(){
        $contacts = Contact::all();
        
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show($id){
        $contact = Contact::find($id);
        $user = User::find($contact->user->id);
        
        return view('admin.contacts.show', compact('contact', 'user'));
    }
}
