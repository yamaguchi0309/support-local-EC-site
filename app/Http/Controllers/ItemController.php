<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Paginator;

class ItemController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function selectItemData(Request $request)
    {
        /* テーブルからレコードを取得する */
        $item_data = Item::where('is_selling', '1')->paginate(6);

        // /* キーワードから検索処理 */
        $keyword = $request->input('keyword');
        if(!empty($keyword)) {//$keyword　が空ではない場合、検索処理を実行します
             $item_data = Item::where('name', 'LIKE', "%{$keyword}%")->where('is_selling', '1')->paginate(6);

        }
        return view('items', compact('item_data'));
    }

    public function findItemData(Request $request) 
    {    
        $item_data = DB::select("SELECT id, name, description, price, tax, stock, is_selling, item_img, memo FROM items WHERE id = '$request->id'"); 
        return view('item.detail', compact('item_data'));
    }

}