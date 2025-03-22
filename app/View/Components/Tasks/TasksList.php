<?php

namespace App\View\Components\tasks;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TasksList extends Component
{
    public $tasks;
    /**
     * Create a new component instance.
     */
    public function __construct($tasks)
    {
        $this->tasks = $tasks;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasks.tasks-list');
    }
}
