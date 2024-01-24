<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ComponenteClase extends Component
{
    public $title;
    public $clases;
    public $variable2;
    /**
     * Create a new component instance.
     */
    public function __construct($title, $clase = 'clase1', $variable2)
    {
        switch($clase) {
            case 'clase1':
                $clases = "bg-blue-100";
                break;
            case 'clase2':
                $clases = "bg-red-100";
                break;
            default:
                $clases = "bg-black-100";
                break;
        }

        $this->title = $title;
        $this->clases = $clases;
        $this->variable2 = $variable2;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.componente-clase');
    }
}
