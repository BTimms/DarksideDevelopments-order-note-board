<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Note;
use Illuminate\Http\Request;

/**
 * Notes Controller to handle logic between the frontend and the database
*/
class NotesController extends Controller
{
    public function index()
    {
        return Note::latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'order_number' => 'required|string|max:255',
            'message' => 'required|string',
            'author' => 'required|string|max:255',
        ]);

        $note = Note::create($validated);

        return response()->json($note, 201);
    }
}
