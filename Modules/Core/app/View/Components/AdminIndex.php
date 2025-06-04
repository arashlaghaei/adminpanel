<?php

namespace Modules\Core\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AdminIndex extends Component
{
    public $title;
    public $permission;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $permission)
    {
        $this->title = $title;
        $this->permission = $permission;
    }

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('core::components.adminindex');
    }
}
