<?php

namespace App\Repositories;

use App\Models\Note;
use App\Repositories\Interfaces\NoteRepositoryInterface;
use Illuminate\Http\Request;

class NoteRepository implements NoteRepositoryInterface
{
    public function search($where, $inicio, $limit = 6):array
    {
        $notes = new Note;

        if($where) {
            $notes = $notes->where('title', 'like', "%$where%")
                ->orWhere('body', 'like', "%$where%");
        }

        $notes = $notes->offset($inicio)
            ->limit(6)
            ->get();

        $noteCount = Note::count();
        if($where) {
            $noteCount = count($notes);
        }

        return [
            'notes' => $notes,
            'noteCount' => $noteCount,
            'limit' => $limit
        ]; 
    }

    public function store(Request $request):void
    {
        if (!empty($request->note_id)) {
            $note = Note::find($request->note_id);
        } else {
            $note = new Note();
        }

        $note->fill($request->all())->save();
    }

    public function delete(Note $note):void
    {
        $note->delete();
    }
}