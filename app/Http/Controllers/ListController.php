<?php

namespace App\Http\Controllers;

use App\Item;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index(){
        $items = Item::all();
        return view('todo')
            ->with(['items'=>$items]);
    }
    public function create(Request $request){
        $item = new Item();
        $item->item = $request->text;
        $item->save();
        return "Done";
    }
}
