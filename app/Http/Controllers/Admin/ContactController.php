<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ContactController extends Controller
{
    public function selectContactData()
    {
        $contact_data = DB::table('contacts')
            ->join('users', 'users.id', '=', 'contacts.user_id')
            ->select('contacts.id', 'users.id as user_id', 'users.name', 'users.kana', 'users.email', 'users.tel', 'users.age', 'users.gender', 'users.memo as user_memo', 'contacts.comment', 'contacts.memo', 'contacts.created_at', 'contacts.updated_at')
            ->where('del_flg','=','1')
            ->paginate(10); 

        return view('admin.contacts', compact('contact_data'));
    }

    public function findContactData(Request $request) 
    {    
        $contact_data = DB::select(
            "SELECT C.id, U.id as user_id, U.name, U.kana, U.email, U.tel, U.age, U.gender, U.memo as user_memo, C.comment, C.memo, C.del_flg
             FROM contacts C
             JOIN  users U ON C.user_id = U.id 
             WHERE C.id = '$request->id' AND C.del_flg = '1'"); 
        return view('admin.contacts.edit', compact('contact_data'));
    }

    public function delete(Request $request) 
    {
        DB::table('contacts')->where('id','=',$request->id)->update([
            'del_flg' => '0',
            ]);
        return view("admin.contacts.delete_complete");  
    }

    public function edit_confirm(Request $request) 
    {
        $contact_memo = $request->post();
        $contact_memo = $request->validate([
            'id' => '',
            'Memo' => 'required',
       ],
       [
            'Memo' => 'メモが未入力',
        ]);

        $contact_data = DB::select(
            "SELECT C.id, U.id as user_id, U.name, U.kana, U.email, U.tel, TIMESTAMPDIFF(YEAR, U.birthday, CURDATE()) AS age, U.gender, U.memo as user_memo, C.comment, U.memo
            FROM contacts C
            JOIN  users U ON C.user_id = U.id 
            WHERE C.id = '$request->id'"); 

        return view('admin.contacts.edit_confirm', compact('contact_memo','contact_data'));
    }

    public function update(Request $request) 
    {    
       DB::table('contacts')->where('id','=',$request->id)->update([
            'memo' => $request->Memo,
            ]);
        return view('admin.contacts.edit_complete');  
    }

}
