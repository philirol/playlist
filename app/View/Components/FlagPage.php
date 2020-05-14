<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FlagPage extends Component
{
    public $band;
    public $type;
    public $page;
    public $position;
    public $margbot;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($band = null, $position, $page, $type, $margbot)
    {
        if ($band) $this->band = $band; else $band = '';
        $this->type = $type;
        $this->page = $page;
        $this->position = $position;
        $this->margbot = $margbot;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.flag-page');
    }
}
