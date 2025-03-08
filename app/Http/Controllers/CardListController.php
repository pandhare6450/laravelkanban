<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\Card;
use App\Models\CardList;
use Illuminate\Http\Request;

class CardListController extends Controller
{
    public function store(Board $board){
        request()->validate([
            'name' => 'required',
        ]);

        CardList::create([
            'board_id' => $board->id,
            'user_id' => auth()->id(),
            'name' => request('name'),
        ]);

        return redirect()->back();
    }

    public function delete($id){
        $list = CardList::findOrFail($id);
        $list->delete();
        return redirect()->back();
    }


}
