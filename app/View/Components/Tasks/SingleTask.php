<?php

namespace App\View\Components\tasks;

use App\Models\Task;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SingleTask extends Component
{
    public Task $task;
    public string $idModal;
    /**
     * Create a new component instance.
     */
    public function __construct(Task $task, string $idModal)
    {
        $this->task = $task;
        $this->idModal = $idModal;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasks.single-task');
    }
}
