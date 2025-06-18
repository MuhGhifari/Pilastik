<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Modal extends Component
{
    public $title;
    public $trigger;

    public function __construct($title = 'Modal', $trigger = 'showModal')
    {
        $this->title = $title;
        $this->trigger = $trigger;
    }

    public function render()
    {
        return view('components.modal');
    }
}
