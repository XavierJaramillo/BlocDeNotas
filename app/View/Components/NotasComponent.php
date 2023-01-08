<?php

namespace App\View\Components;

use Illuminate\View\Component;

class NotasComponent extends Component
{
    public $notas;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $notas)
    {
        $this->notas = $notas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notas');
    }
}
