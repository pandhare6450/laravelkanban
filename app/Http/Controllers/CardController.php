<?php

namespace App\Http\Controllers;
use App\Models\Card;
use Inertia\Inertia;

class CardController extends Controller
{
    public function cards_store(){
        request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'board_id' => 'required','exists:boards,id',
            'card_list_id' => 'required','exists:card_lists,id',
        ]);

        Card::create([
            'board_id' => request('board_id'),
            'card_list_id' => request('card_list_id'),
            'user_id' => auth()->id(),
            'title' => request('title'),
            'description' => request('description',null),
        ]);

        return redirect()->back();
    }

  
    function card_delete($id){
        $list = Card::findOrFail($id);
        $list->delete();
        return redirect()->back();
    }
    public function update(Card $card){
        request()->validate([
            'title' => 'required',
            'description' => 'nullable',
        ]);

        $card->update([
            'title' => request('title'),
            'description' => request('description',null),
        ]);

        return redirect()->back();
    }

    public function move(Card $card){
        request()->validate([
            'cardListId' => ['required', 'exists:card_lists,id'],
            'position' => ['required', 'numeric']
        ]);
 
        $card->update([
            'card_list_id' => request('cardListId'),
            'position' => round(request('position'), 5)
        ]);

        return Inertia::render('Boards/Show', [
            'id' => $card->board_id
        ]);
    }

}
