<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotesComponent extends Component
{
    public $notes;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $notes)
    {
        $this->notes = $notes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notes');
    }
}
