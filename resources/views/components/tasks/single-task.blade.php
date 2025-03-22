<div
    class="overflow-hidden hover:scale-102 transition-transform duration-200 ease-in-out shadow-xl rounded-2xl {{ $attributes->get('size') }}">
    <div class="flex items-center flex-nowrap px-4 py-2 bg-neutral-950/20">
        <p class="grow text-neutral-200 text-lg overflow-hidden no-wrap">{{ $task->limitTitle(30) }}</p>
        @if ($task->is_completed)
            <span class="size-5 rounded-full from-lime-400 to-green-500 bg-gradient-to-r"></span>
        @elseif ($task->isOverdue())
            <span class="size-5 rounded-full from-red-500 to-red-600 bg-gradient-to-r"></span>
        @else
            <span class="size-5 rounded-full from-yellow-400 to-orange-400 bg-gradient-to-r"></span>
        @endif
    </div>
    <div class="bg-neutral-800/50 px-2 py-2 h-20 max-h-18 overflow-hidden">
        <p class="text-neutral-500 text-sm">{{ $task->limitDescription(135) }}</p>
    </div>
    <div class="flex justify-between items-center pb-3 pt-2 px-3 gap-x-1 bg-neutral-800/70">
        <div>
            @if ($task->is_completed)
                <p class="text-green-500 bg-green-500/15 rounded-full px-3 font-semibold text-lg"><i
                        class="fa-solid fa-check me-1"></i>Completed</p>
            @else
                @if ($task->due_date)
                    @if ($task->isOverdue())
                        <p class="text-red-500 bg-red-600/15 rounded-full px-3 font-semibold text-lg">
                            {{ $task->due_date_formatted }}</p>
                    @else
                        <p class="text-lime-400 bg-lime-500/15 rounded-full px-3 font-semibold text-lg">
                            {{ $task->due_date_formatted }}</p>
                    @endif
                @else
                    <div class="flex flex-wrap overflow-scroll">

                        @foreach ($task->recurring_days as $day)
                            <p
                                class="text-emerald-500 bg-emerald-500/15 rounded-full px-1.25 me-0.75 mb-0.5 font-semibold text-sm">
                                {{ substr(strtoupper($day), 0, 3) }}
                            </p>
                            @if ($loop->iteration === 4)
                                <p
                                    class="text-emerald-500 bg-emerald-500/15 rounded-full px-1.5 me-1 mb-1 font-semibold text-sm">
                                    ...
                                </p>
                                @break
                            @endif
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
        <div class="flex gap-x-2">
            <a class="icon-options hover:border-emerald-500! hover:text-emerald-500!"
                href="{{ route('tasks.edit', ['task' => $task->id]) }}">
                <i class="fa-solid fa-chevron-right px-0.75"></i>
            </a>
            @if (!$task->is_completed)
                <a onclick="openModal('{{ $idModal }}')"
                    class="icon-options cursor-pointer hover:border-green-500! hover:text-green-500!">
                    <i class="fa-solid fa-check px-0.25"></i>
                </a>
            @endif
        </div>
    </div>
</div>
