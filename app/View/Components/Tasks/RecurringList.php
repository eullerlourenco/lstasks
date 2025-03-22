<?php

namespace App\View\Components\Tasks;

use Carbon\Carbon;
use Closure;
use DateTime;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class RecurringList extends Component
{
    public array $tasks;
    public array $recurringDays = [];
    protected array $recurringDaysList = [
        'sunday' => 'SUN',
        'monday' => 'MON',
        'tuesday' => 'TUE',
        'wednesday' => 'WED',
        'thursday' => 'THU',
        'friday' => 'FRI',
        'saturday' => 'SAT'
    ];

    /**
     * Create a new component instance.
     */
    public function __construct(Collection $tasks, string $baseDayForWeek)
    {
        $base = Carbon::parse($baseDayForWeek)->startOfWeek(0)->setTime(23, 23, 59);

        $tasksPerDay = [];
        for ($i = 0; $i <= 6; $i++) {
            $day = $base->copy()->addDays($i);
            $value = strtolower($day->format('l'));

            $this->recurringDays[strtolower($value)] = [
                'value' => strtolower($value),
                'label' => substr(strtoupper($value), 0, 3),
                'date' => $day->format('d/m'),
                'active' => '',
                'dateFormat' => $day->format('Y-m-d'),
            ];

            $tasksPerDay[$value] = [];
            foreach ($tasks as $task) {

                if ($task->type === 'recurring' && in_array(strtolower($value), $task->recurring_days) && $day->greaterThanOrEqualTo($task->created_at)) {
                    $tasksPerDay[$value][] = $task;
                } elseif ($task->type === 'fixed' && Carbon::parse($task->due_date)->isSameDay($day)) {
                    $tasksPerDay[$value][] = $task;
                }
            }
        }

        $this->tasks = $tasksPerDay;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tasks.recurring-list');
    }
}
