<?php

namespace App\View\Components;

use App\Models\Nota;
use Illuminate\View\Component;

class FormNotaComponent extends Component
{
    public $nota;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Nota $nota = new Nota())
    {
        $this->nota = $nota;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-nota-component');
    }
}
