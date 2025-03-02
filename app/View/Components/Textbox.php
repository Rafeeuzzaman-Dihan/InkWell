<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Textbox extends Component
{
    public $name;
    public $placeholder;
    public $type;
    public $required;
    public $label;
    public $id;
    public $class;

    public function __construct($name, $placeholder, $type = 'text', $required = true, $label = null, $id = null, $class = '')
    {
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->type = $type;
        $this->required = $required;
        $this->label = $label ?? ucfirst($name); 
        $this->id = $id ?? $name;
        $this->class = $class;
    }

    public function render()
    {
        return view('components.textbox');
    }
}
