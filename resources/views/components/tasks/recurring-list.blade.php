<div class="mt-9 mb-6 {{ $attributes->get('class') }}">

    @foreach ($recurringDays as $day => $values)
        <div class="group hover:scale-102 transition-transform duration-100 ease-in mb-3">
            <p
                class="text-3xl italic text-neutral-600 group-hover:text-lime-400 duration-200 ease-in font-bold pb-2 border-b border-neutral-800">
                {{ strtoupper($values['label']) }}
                <span class="text-xl! font-normal">
                    {{ $values['date'] }}
                </span>
            </p>
            @foreach ($tasks[$day] as $task)
                <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">
                    <div
                        class="flex items-center p-1 hover:scale-101 transition-transform duration-200 cursor-pointer text-neutral-600 hover:text-lime-400">
                        <p class="leading-4 text-sm">{{ $task->limitTitle(37) }}</p>
                        <i class="fa-solid fa-chevron-right ms-3 md:sm-0"></i>
                    </div>
                </a>
                @if ($loop->iteration === 2)
                    <a href="{{ route('tasks.index', ['startDate' => $values['dateFormat'], 'endDate' => $values['dateFormat']]) }}">
                        <div
                            class="flex items-center p-1 hover:scale-101 transition-transform duration-200 cursor-pointer text-neutral-600 hover:text-orange-400">
                            <p class="flex-grow leading-4 text-sm">See all</p>
                            <i class="fa-solid fa-chevron-right"></i>
                        </div>
                    </a>
                    @break
                @endif
            @endforeach
        </div>
    @endforeach
</div>
