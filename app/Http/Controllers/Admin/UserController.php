<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function selectUserData(Request $request)
    {
        $user_data = DB::table('users')->paginate(10); 
        // /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
            $user_data = User::where('name', 'LIKE', "%{$keyword}%")
             ->orwhere('name', 'LIKE', "%{$keyword}%")
             ->orwhere('kana', 'LIKE', "%{$keyword}%")
             ->orwhere('email', 'LIKE', "%{$keyword}%")
             ->orwhere('tel', 'LIKE', "%{$keyword}%")
             ->orwhere('postcode', 'LIKE', "%{$keyword}%")
             ->orwhere('birthday', 'LIKE', "%{$keyword}%")
             ->orwhere('gender', 'LIKE', "%{$keyword}%")
             ->orwhere('belongs', 'LIKE', "%{$keyword}%")
             ->orwhere('memo', 'LIKE', "%{$keyword}%")->paginate(10);             
        }
        return view('admin.users', compact('user_data','keyword'));
    }

    public function findUserData(Request $request) 
    {    
        $user_data = DB::select("SELECT id, name, kana, email, tel, postcode, address, birthday, gender, memo FROM users WHERE id = '$request->id'"); 
        return view('admin.users.edit', compact('user_data'));
    }

    public function delete(Request $request) 
    {
        DB::table('users')->where('id','=',$request->id)->update([
            'belongs' => '0',
            ]);
        return view("admin.users.delete");  
    }

    public function edit_confirm(Request $request) 
    {
        $user_memo = $request->post();
        $user_memo = $request->validate([
            'id' => '',
            'Memo' => 'required',
            ],
            [
            'Memo' => 'メモが未入力',
            ]);

        $user_data = DB::select("SELECT id, name, kana, email, tel, postcode, address, birthday, gender FROM users WHERE id = '$request->id'"); 

        return view('admin.users.edit_confirm', compact('user_memo','user_data'));
    }

    public function update(Request $request) 
    {    
       DB::table('users')->where('id','=',$request->id)->update([
            'memo' => $request->Memo,
            ]);
        return view('admin.users.edit_complete');  
    }

}