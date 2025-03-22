<?php

namespace App\Models;

use App\Models\Scopes\TaskUserScope;
use Carbon\Carbon;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Task extends Model
{
    protected static function booted():void 
    {
        static::addGlobalScope(new TaskUserScope);
    }

    protected $fillable = [
        'user_id',
        'parent_id',
        'title',
        'description',
        'type',
        'is_completed',
        'recurring_days',
        'due_date',
        'completed_at'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function subtasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_Id');
    }

    public function getDueDateFormattedAttribute(): string
    {
        return Carbon::parse($this->due_date)->format('d/m/Y');
    }

    public function getCompletedDateAttribute(): string
    {
        return Carbon::parse($this->completed_at)->format('d/m/Y H:m');
    }

    public function limitDescription(int $limit): string
    {
        if ($this->description) {
            return substr($this->description, 0, $limit) . (strlen($this->description) <= $limit ? '' : '...');
        }
        return '';
    }

    public function limitTitle(int $limit): string
    {
        if ($this->title) {
            return substr($this->title, 0, $limit) . (strlen($this->title) <= $limit ? '' : '...');
        }
        return '';
    }

    public function isOverdue(): bool 
    {
        if($this->due_date) {
            return now()->greaterThan(($this->due_date . ' 23:23:59'));
        } 
        return false;
    }

    public function scopeIsCompleted(Builder $query, bool $value): void
    {
        $query->where('is_completed', $value);
    }

    public function scopeRecurringDays(Builder $query, string $start, string $end): void
    {
        $query->whereNotExists(function ($subQuery) use ($start, $end) {
            $subQuery->select(DB::raw(1))
                ->from('tasks as subtasks')
                ->whereColumn('tasks.id', 'subtasks.parent_id')
                ->where('subtasks.is_completed', true)
                ->whereBetween('subtasks.completed_at', [$start, $end]);
        });
    }

    protected $casts = [
        'recurring_days' => 'json'
    ];
}
