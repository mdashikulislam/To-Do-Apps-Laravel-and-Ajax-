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
    public function delete(Request $request){
        $item = Item::where('id',$request->id)->delete();
        return "Delete";
    }
    public function update(Request $request){
        $item = Item::find($request->id);
        $item->item = $request->item;
        $item->save();
        return "Update";
    }
    public function search(Request $request){
        $term = $request->term;
        $items = Item::where('item','LIKE','%'.$term.'%')->get();
        if (count($items) == 0){
            return $searchItem[] = "No Item Found";
        }else{
           foreach ($items as $item){
               $searchItem[] = $item->item;
           }
        }
        return $searchItem;
    }
}
