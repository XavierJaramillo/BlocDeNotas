<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\NoteRequest;
use App\Models\Note;
use App\Repositories\Interfaces\NoteRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\View\View;
use Exception;

class NotesController extends Controller
{
    private $noteRepository;

    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view('notes.index', [
            'notes' => Note::paginate(6)
        ]);
    }

    /**
     * Return a rendered blade of component notes
     */
    public function getNotes(Request $request, int $pagina)
    {
        if ($request->ajax()) {
            $start = ($pagina * 6) - 6;

            $data = $this->noteRepository->search(null, $start);

            return Blade::render(
                '<x-notes :notes="$notes" />',
                [
                    "notes" => new LengthAwarePaginator($data['notes'], Note::count(), $data['limit'], $pagina)
                ]
            );
        }
    }

    /**
     * Returns a rendered sheet and filtered of notes component
     */
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $start = ($request->page * 6) - 6;

            $data = $this->noteRepository->search($request->where, $start);

            return Blade::render(
                '<x-notes :notes="$notes" />',
                [
                    "notes" => new LengthAwarePaginator($data['notes'], $data['noteCount'], 6, $request->page)
                ]
            );
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Blade
     */
    public function create()
    {
        return Blade::render(
            '<x-form-note-component />'
        );
    }

    /**
     * Store in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoteRequest $request)
    {
        try {
            $this->noteRepository->store($request);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()], 400);
        }

        return response()->json(['success' => true, 'msg' => 'Nota guardado correctamente.'], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Blade
     */
    public function edit(Note $note)
    {
        return Blade::render(
            '<x-form-note-component :note="$note" />',
            [
                "note" => $note
            ]
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        try {
            $this->noteRepository->delete($note);
            return response()->json("Nota eliminada correctamente.");
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }
}
