<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
      }
    public function findUserData(Request $request) 
    {    
        $user_data = DB::select(
            "SELECT id, name, kana, email, tel, postcode, address, birthday, gender 
            FROM users 
            WHERE id = '$request->id'"); 

        return view('mypage.edit', compact('user_data'));
    }

    public function edit_confirm(Request $request) 
    {
        $user_data = $request->post();
        $user_data = $request->validate([
            'id'=> 'required',
            'Name' => 'required',
            'Kana' => 'required',
            'Email' => 'required|email',
            'Tel' => 'required|regex:/^0[0-9]{10,11}$/',
            'Postcode' => 'required|digits:7',
            'Address' => 'required',
            'Birthday' => 'required|date',
            'Gender' => 'required',
       ],
       [
            'id.required' => 'IDがありません',
            'Name.required' => '名前は必須項目です。',
            'Kana.required' => 'カナは必須項目です。',
            'Email.required' => 'Eメールアドレスは必須項目です。',
            'Email.email' => '正しいEメールアドレスを入力してください。',
            'Tel.required' => '電話番号は必須項目です。',
            'Tel.regex' => '数字のみで、正しい電話番号を入力してください。',
            'Postcode.required' => '郵便番号は必須項目です。',
            'Postcode.digits' => '数字のみで、正しい郵便番号を入力してください。',
            'Address.required' => '住所は必須項目です。',
            'Birthday.required' => '誕生日は必須項目です。',
            'Birthday.date' => '誕生日は正しい日付を入力してください。',
            'Gender.required' => '性別の回答は必須項目です。',
        ]);

        return view('mypage.edit_confirm', compact('user_data'));
    }

    public function update(Request $request) 
    {    
       DB::table('users')->where('id','=',$request->id)->update([
                'name' => $request->Name,
                'kana' => $request->Kana,
                'email' => $request->Email,
                'tel' => $request->Tel,
                'postcode' => $request->Postcode,
                'address' => $request->Address,
                'birthday' => $request->Birthday,
                'gender' => $request->Gender, 
            ]);

        $user_age = DB::select(
            "SELECT TIMESTAMPDIFF(YEAR, `birthday`, CURDATE()) AS age
            FROM users 
            WHERE id = '$request->id'"); 

        DB::table('users')->where('id','=',$request->id)->update([
                'age' => $user_age,
            ]);

        return view('mypage.edit_complete');  
    }
}