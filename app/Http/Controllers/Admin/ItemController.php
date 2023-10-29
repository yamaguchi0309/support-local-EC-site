<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class ItemController extends Controller
{
    public function selectItemData(Request $request)
    {
        /* テーブルからレコードを取得する */
        $item_data = DB::table('items')->paginate(10);

        // /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
             $item_data = Item::where('is_selling', '1')
             ->where('name', 'LIKE', "%{$keyword}%")
             ->orwhere('description', 'LIKE', "%{$keyword}%")
             ->orwhere('item_img', 'LIKE', "%{$keyword}%")
             ->orwhere('name', 'LIKE', "%{$keyword}%")->paginate(10);

        }
        return view('admin.items', compact('item_data','keyword'));
    }

    public function confirm(Request $request) 
    {
        $item_data = $request->post();
        $item_data = $request->validate([
            'Name' => 'required',
            'Description' => 'required|max:150',
            'Price' => 'required|integer',
            'Tax' => 'required',
            'Stock' => 'required|integer',
            'Is_selling' => 'required',
            'Item_img' => 'required',
            'Memo' => '',
       ],
       [
            'Name.required' => '商品名が未入力',
            'Description.required' => '商品説明が未入力',
            'Description.max' => '商品説明は150文字以内',
            'Price.required' => '価格が未入力',
            'Price.integer' => '価格は数値入力',
            'Stock.required' => '在庫が未入力',
            'Stock.integer' => '在庫は数値入力',
            'Item_img.required' => '画像ファイル名が未入力',
        ]);                

        return view('admin.items.confirm', compact('item_data'));
    }

    public function insert(Request $request) 
    {    
        \DB::table('items')->insert([
            'name' => $request->Name,
            'description' => $request->Description,
            'price' => $request->Price,
            'tax' => $request->Tax,
            'stock' => $request->Stock,
            'is_selling' => $request->Is_selling,
            'item_img' => $request->Item_img,
            'memo' => $request->Memo,
        ]);
        return view('admin.items.complete');
    }

    public function findItemData(Request $request) 
    {    
        $item_data = DB::select("SELECT id, name, description, price, tax, stock, is_selling, item_img, memo FROM items WHERE id = '$request->id'"); 
        return view('admin.items.edit', compact('item_data'));
    }

    public function delete(Request $request) 
    {
        DB::table('items')->where('id','=',$request->id)->delete();
        return view("admin.items.delete");  
    }

    public function edit_confirm(Request $request) 
    {
        $item_data = $request->post();
        $item_data = $request->validate([
            'id'=> 'required',
            'Name' => 'required',
            'Description' => 'required|max:150',
            'Price' => 'required|integer',
            'Tax' => 'required',
            'Stock' => 'required|integer',
            'Is_selling' => 'required',
            'Item_img' => 'required',
            'Memo' => '',
       ],
       [
            'id.required' => 'IDがありません',
            'Name.required' => '商品名が未入力',
            'Description.required' => '商品説明が未入力',
            'Description.max' => '商品説明は150文字以内',
            'Price.required' => '価格が未入力',
            'Price.integer' => '価格は数値入力',
            'Stock.required' => '在庫が未入力',
            'Stock.integer' => '在庫は数値入力',
            'Item_img.required' => '画像ファイル名が未入力',
        ]);                

        return view('admin.items.edit_confirm', compact('item_data'));
    }

    public function update(Request $request) 
    {    
       DB::table('items')->where('id','=',$request->id)->update([
            'name' => $request->Name,
            'description' => $request->Description,
            'price' => $request->Price,
            'tax' => $request->Tax,
            'stock' => $request->Stock,
            'is_selling' => $request->Is_selling,
            'item_img' => $request->Item_img,
            'memo' => $request->Memo,
            ]);
        return view('admin.items.edit_complete');  
    }

}