<?php

namespace App\View\Components\Tasks;

use App\Models\Task;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditTaskForm extends Component
{
    public Task $task;
    public array $options = [
        'sunday' => 'Sunday',
        'monday' => 'Monday',
        'tuesday' => 'Tuesday',
        'wednesday' => 'Wednesday',
        'thursday' => 'Thursday',
        'friday' => 'Friday',
        'saturday' => 'Saturday',
    ];
    public bool $isRecurring;
    public array $checkedOptions;
    public $disabled;

    /**
     * Create a new component instance.
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
        $this->isRecurring = $task?->type === 'recurring' ? true : false;
        $this->checkedOptions = $task->type === 'recurring' ? $task->recurring_days : [];
        $this->disabled = $task->is_completed ? 'disabled' : '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasks.edit-task-form');
    }
}
