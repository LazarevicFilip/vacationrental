<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OptionTag extends Component
{
   public $val,$name,$selected;

    public function __construct($val,$name,$selected="")
    {
        $this->val = $val;
        $this->name = $name;
        $this->selected = $selected;
    }


    public function render()
    {
        return view('components.option-tag');
    }
}
