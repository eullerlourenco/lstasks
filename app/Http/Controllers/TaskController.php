<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    protected array $userValidationRules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'is_recurring' => 'nullable|in:selected',
        'recurring_days' => 'nullable|required_if:is_recurring,selected|array',
        'recurring_days.*' => 'in:sunday,monday,tuesday,wednesday,thursday,friday,saturday',
        'due_date' => 'nullable|required_unless:is_recurring,selected|date',
    ];

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::query();

        $query->when($request->startDate && $request->endDate, function (Builder $builder) use ($request) {
            if (strtotime($request->startDate) <= strtotime($request->endDate)) {
                $startDate = Carbon::parse($request->startDate . ' 00:00:00')->toDateTimeString();
                $endDate = Carbon::parse($request->endDate . ' 23:23:59')->toDateTimeString();
                $period = collect(CarbonPeriod::create($startDate, $endDate))
                    ->map(function ($date) {
                        return [
                            'date' => $date->format('Y-m-d 23:23:59'),
                            'day' => strtolower($date->format('l')),
                        ];
                    })
                    ->unique()
                    ->toArray();
                $builder->where(function (Builder $b) use ($startDate, $endDate, $period) {
                    $b->whereBetween('due_date', [$startDate, $endDate])
                        ->orWhereBetween('completed_at', [$startDate, $endDate])
                        ->orWhere(function (Builder $b2) use ($period) {
                            $b2->where('type', 'recurring')
                                ->where('is_completed', false)
                                ->where(function (Builder $b3) use ($period) {
                                    foreach ($period as $values) {
                                        $b3->orWhere('created_at', '<=', $values['date']);
                                    }
                                })
                                ->where(function (Builder $b3) use ($period) {
                                    foreach ($period as $values) {
                                        $b3->orWhereRaw("JSON_CONTAINS(recurring_days, ?)", [json_encode($values['day'])]);
                                    }
                                });
                        });
                });
            }
        });

        $query->when($request?->keyword, function (Builder $builder, $keyword) {
            $builder->where(function (Builder $b) use ($keyword) {
                $b->whereLike('title', '%' . $keyword . '%')
                    ->orWhereLike('description', '%' . $keyword . '%');
            });
        });

        $query->when($request->status && $request->status !== 'all', function (Builder $builder) use ($request) {
            $builder->where('is_completed', $request->status === 'completed');
        });

        $query->when($request->type && $request->type !== 'all', function (Builder $builder) use ($request) {
            $builder->where('type', $request->type);
        });

        $startDate = $request->startDate ?
            Carbon::parse($request->startDate)->startOfWeek(0)->format('Y-m-d 00:00:00') :
            Carbon::now()->startOfWeek(0)->format('Y-m-d 00:00:00');
        $endDate = $request->endDate ?
            Carbon::parse($request->endDate)->endOfWeek(6)->format('Y-m-d 23:23:59') :
            Carbon::now()->endOfWeek(6)->format('Y-m-d 23:23:59');

        $query->when(!$request->startDate && !$request->endDate, function (Builder $builder) use ($startDate, $endDate) {
            $builder->whereBetween('due_date', [$startDate, $endDate])
                ->orWhereBetween('completed_at', [$startDate, $endDate])
                ->orWhere(function (Builder $b) use ($startDate) {
                    $b->where('type', 'recurring')
                        ->where('is_completed', false)
                        ->orwhere('completed_at', '>=', $startDate);
                });
            $builder->orWhere(function (Builder $b) {
                $b->where('type', 'fixed')
                    ->where('due_date', '<', now())
                    ->where('is_completed', false);
            });
        });

        $query
            ->orderBy('is_completed', 'ASC')
            ->orderBy('type', 'ASC')
            ->orderBy('due_date', 'ASC');
        $tasks = $query->simplePaginate(12);

        $recurringTasks =
            Task::recurringDays($startDate, $endDate)
            ->isCompleted(false)
            ->get();

        $filter = $request->all();

        return view('pages.tasks.index', compact('tasks', 'recurringTasks', 'filter'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate($this->userValidationRules);

        $type = $request->has('is_recurring') ? 'recurring' : 'fixed';

        $orderOfRecurringDays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        if ($request->has('recurring_days')) {
            $recurringDays = collect($request->recurring_days)
                ->sortBy(fn($day) => array_search($day, $orderOfRecurringDays))
                ->values()
                ->all();
        } else {
            $recurringDays = null;
        }

        Task::create([
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $type,
            'recurring_days' => $type === 'recurring' ? $recurringDays : null,
            'due_date' => $type === 'fixed' ? $validated['due_date'] : null,
        ]);

        return redirect()->route('tasks.index')->with('alertSuccess', 'The task was created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        Gate::authorize('update', $task);

        return view('pages.tasks.edit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Task $task, Request $request)
    {
        Gate::authorize('update', $task);

        $validated = $request->validate($this->userValidationRules);

        if ($task->is_completed) {
            return redirect()->back()->with('alertError', 'Task cannot be complete for modification');
        }
        $type = $request->has('is_recurring') ? 'recurring' : 'fixed';
        $orderOfRecurringDays = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        if ($request->has('recurring_days')) {
            $recurringDays = collect($request->recurring_days)
                ->sortBy(fn($day) => array_search($day, $orderOfRecurringDays))
                ->values()
                ->all();
        } else {
            $recurringDays = null;
        }

        $data = [
            'title' => $validated['title'],
            'description' => $validated['description'] ?? $task->description,
            'type' => $type,
        ];

        if ($task->type !== $type) {

            if ($type === 'fixed') {
                $data['recurring_days'] = null;
                $data['due_date'] = $validated['due_date'];
            } else {
                $data['recurring_days'] = $recurringDays;
                $data['due_date'] = null;
            }
        } else {
            $data['recurring_days'] = $type === 'recurring' ? $recurringDays : $task->recurring_days;
            $data['due_date'] = $type === 'fixed' ? $validated['due_date'] : $task->due_date;
        }

        $task->update($data);

        return redirect()->back()->with('alertSuccess', 'The task updated successfully!');
    }

    public function complete(Task $task)
    {
        Gate::authorize('update', $task);

        if ($task->is_completed) {
            return redirect()->back()->with('alertError', 'The task is already complete!');
        }

        if ($task->type === 'fixed') {
            $task->is_completed = true;
            $task->completed_at = Carbon::now();
            $task->save();
        } else {
            $newTask = $task->replicate();
            $newTask->parent_id = $task->id;
            $newTask->is_completed = true;
            $newTask->completed_at = Carbon::now();
            $newTask->save();
        }

        return redirect()->back()->with('alertSuccess', 'The task was completed with success!');
    }

    public function reopen(Task $task)
    {
        Gate::authorize('update', $task);

        if (!$task->is_completed) {
            return redirect()->back()->with('alertError', "The task isn't completed!");
        }

        if ($task->type === 'recurring' && $task->parent_id) {
            $task->delete();
        } else {
            $task->is_completed = false;
            $task->completed_at = null;
            $task->save();
        }

        return redirect()->route('tasks.index')->with('alertSuccess', 'The task status return to pending!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        Gate::authorize('delete', $task);

        $task->subtasks()->update(['parent_id' => null]);
        $task->delete();

        return redirect()->route('tasks.index')->with('alertSuccess', 'The task was deleted successfully!');
    }
}
