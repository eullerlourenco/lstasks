<?php

namespace App\View\Components\General;

use Carbon\Carbon;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FilterTasks extends Component
{
    public string $startDate;
    public string $endDate;
    public string $status;
    public string $type;
    public string $keyword;

    /**
     * Create a new component instance.
     */
    public function __construct(array $filter)
    {
        $this->startDate = $filter['startDate'] ?? Carbon::now()->startOfWeek(0)->format('Y-m-d');
        $this->endDate = $filter['endDate'] ?? Carbon::now()->endOfWeek(6)->format('Y-m-d');
        $this->status = $filter['status'] ?? 'all';
        $this->type = $filter['type'] ?? 'all';
        $this->keyword = $filter['keyword'] ?? '';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.general.filter-tasks');
    }
}
