<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class BoardController extends Controller
{
	public function index()
	{
		return Inertia::render('Boards/Index', [
			'boards' => auth()->user()->boards()->latest()->get()
		]);
	}

	public function show(Board $board)
	{
		$board->load([
			'lists.cards' => fn($query) => $query->orderBy('position')
		]);
		return Inertia::render('Boards/Show', [
			'board' => $board
		]);
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required',
		]);

		Board::create([
			'name' => $request->name,
			'user_id' => auth()->id()
		]);

		return redirect()->back();
	}

	public function update(Board $board)
	{
		request()->validate([
			'name' => 'required',
		]);

		$board->update([
			'name' => request('name'),
		]);

		return redirect()->back();
	}
}
