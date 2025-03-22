<?php

namespace App\View\Components\Tasks;

use App\Models\Task;
use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class UserTasksAchievements extends Component
{
    public string $completedTasks;
    public int $tasksToDo = 0;
    public int $overdueTasks = 0;
    public int $completedCurrentWeek = 0;
    public int $completedCurrentMonth = 0;
    public int $completedCurrentYear = 0;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->completedTasks = Task::isCompleted(true)->count();
        $this->tasksToDo = Task::isCompleted(false)->count();
        $this->overdueTasks = Task::isCompleted(false)->where('type', 'fixed')->where('due_date', '<', date('Y-m-d'))->count();
        $this->completedCurrentWeek = Task::isCompleted(true)->whereBetween('completed_at', [
            Carbon::now()->startOfWeek(0)->format('Y-m-d H:i:s'),
            Carbon::now()->endOfWeek(6)->format('Y-m-d H:i:s'),
        ])->count();
        $this->completedCurrentMonth = Task::isCompleted(true)->whereBetween('completed_at', [
            Carbon::now()->startOfMonth()->format('Y-m-d H:i:s'),
            Carbon::now()->endOfMonth()->format('Y-m-d H:i:s'),
        ])->count();
        $this->completedCurrentYear = Task::isCompleted(true)->whereBetween('completed_at', [
            Carbon::now()->startOfYear()->format('Y-m-d H:i:s'),
            Carbon::now()->endOfYear()->format('Y-m-d H:i:s'),
        ])->count();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasks.user-tasks-achievements');
    }
}
