<?php

namespace App\View\Components;

use App\Models\Note;
use Illuminate\View\Component;

class FormNoteComponent extends Component
{
    public $note;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Note $note = new Note())
    {
        $this->note = $note;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-note-component');
    }
}
