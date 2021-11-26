<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Contact;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Auth;


class ContactsController extends Controller
{
    public function create(){
        return view('contacts.create');
    }

    public function confirm(Request $request){

        //  バリデーションは後ほどフォームリクエストにまとめる
        $request->validate([
            'title'    => 'required',
            'content' => 'required',
        ]);
        
        return view('contacts.confirm', compact('request'));
    }

    public function store(Request $request){
        $action = $request->get('action');
        $input  = $request->except('action');
        
        if($action === 'submit'){
            $contact = new Contact;
            $contact->title = $request->title;
            $contact->content = $request->content;
            $contact->user_id = Auth::id();

            $contact->save();

            // メール送信
            Mail::to(Auth::user()->email)->send(new ContactMail('emails.contact', 'お問い合わせありがとうございます', $input));
            
            return redirect()->route('contacts.complete');
        } else {
            return redirect()->route('contacts.create')->withInput($input);
        }

    }

    public function complete(){
        return view('contacts.complete');
    }
}
