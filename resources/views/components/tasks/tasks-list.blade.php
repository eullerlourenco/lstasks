@if ($tasks->isNotEmpty())
    <div class="grid-cols-1 md:grid-cols-2 xl:grid-cols-4 2xl:grid-cols-5 grid gap-x-4 gap-y-5">
        @foreach ($tasks as $task)
            <x-tasks.single-task :task="$task" :id-modal="'completeModalTask' . $task->id" />
            @if (!$task->is_completed)
                <x-general.modal :id="'completeModalTask' . $task->id">
                    <div class="text-center">
                        <i
                            class="fa-solid fa-check text-3xl text-green-500 bg-gradient-to-r from-lime-400/15 to-green-500/15 rounded-full p-3 px-3.5"></i>
                    </div>
                    <div>
                        <h3 class="text-xl text-neutral-100 text-center mb-2">Mark task as completed?</h3>
                        <h3 class="text-md text-neutral-500 text-center">{{ $task->limitTitle(40) }}</h3>
                    </div>
                    <div class="flex justify-center gap-3 mb-4 mt-6">
                        <form action="{{ route('tasks.complete', [$task->id]) }}" method="POST">
                            @method('PATCH')
                            @csrf
                            <button type="submit" class="btn-primary">
                                <i class="fa-solid fa-check me-0 md:me-1"></i>
                                <p class="hidden md:inline">Yes, i completed</p>
                            </button>
                        </form>
                        <a onclick="closeModal('{{ 'completeModalTask' . $task->id }}')" class="btn-secondary">
                            <i class="fa-solid fa-ban me-0 md:me-1"></i>
                            <p class="hidden md:inline">No, cancel</p>
                        </a>
                    </div>
                </x-general.modal>
            @endif
        @endforeach
    </div>
    <div class="my-6">
        {{ $tasks->links() }}
    </div>
@else
    <div class="text-center mt-30 mb-10">
        <p class="text-neutral-500 text-lg">No tasks found</p>
    </div>
@endif
