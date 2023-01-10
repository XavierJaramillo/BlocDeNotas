<?php
namespace App\Repositories\Interfaces;

use App\Models\Note;
use Illuminate\Http\Request;

Interface NoteRepositoryInterface
{
    public function search(string|null $where, int $inicio, int $limit = 6):array;
    public function store(Request $request):void;
    public function delete(Note $note):void;
}