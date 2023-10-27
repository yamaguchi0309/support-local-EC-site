<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }
    public function confirm(Request $request) 
    {
        $contact_data = $request->post();
        $contact_data = $request->validate([
            'id' => 'required',
            'Comment' => 'required',
       ],
       [
            'Comment.required' => 'お問い合わせ内容が未入力です。',
        ]);                

        return view('contact.confirm', compact('contact_data'));
    }

    public function insert(Request $request) 
    {    
        \DB::table('contacts')->insert([
            'user_id' => $request->id,
            'comment' => $request->Comment,
        ]);
        return view('contact.complete');
    }

}