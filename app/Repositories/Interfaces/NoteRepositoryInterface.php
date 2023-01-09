<?php
namespace App\Repositories\Interfaces;

Interface NoteRepositoryInterface
{
    public function searchNotes(string|null $where, int $inicio, int $limit = 6):array;
    public function storeNote(object $request):void;
}