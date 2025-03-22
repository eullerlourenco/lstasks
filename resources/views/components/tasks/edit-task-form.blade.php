<div class="flex items-start justify-center">
    <div class="w-full md:w-2/3 lg:w-4/7 bg-neutral-800 shadow-xl rounded-3xl overflow-hidden">
        <form action="{{ route('tasks.update', [$task->id]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="flex flex-col items-center">
                <div class="mb-7 w-full flex justify-end bg-neutral-950/20 py-6">
                    @if ($task->is_completed)
                        <h2
                            class="text-green-500 bg-gradient-to-r from-lime-400/15 to-green-500/15 me-5 px-3 py-1 rounded-full text-center text-2xl">
                            <i class="fa-solid fa-check me-1"></i>
                            Completed
                        </h2>
                    @else
                        <h2
                            class="text-amber-500 bg-gradient-to-r from-orange-500/15 to-amber-500/15 me-5 px-3 py-1 rounded-full text-center text-2xl">
                            <i class="fa-solid fa-clock me-1"></i>
                            Pending
                        </h2>
                    @endif
                </div>
                <div class="w-full md:w-4/5 px-5 bg-neutral-800/50">
                    <div class="grid gap-y-4">
                        @if ($task->is_completed)
                            <div class="flex">
                                <x-forms.input-group label="Completed at" name="completed_at" id="completed_at"
                                    :disabled="$disabled" :default-value="$task?->completedDate" />
                            </div>
                        @endif
                        <x-forms.input-group name="title" id="title" placeholder="Title" :disabled="$disabled"
                            :default-value="$task?->title" />
                        <x-forms.textarea-input rows="6" name="description" id="description" :disabled="$disabled"
                            placeholder="Description" :default-value="$task?->description" />
                        <div class="grid grid-cols-4">
                            @php
                                $checked = old('is_recurring', $isRecurring) ? true : false;
                            @endphp
                            <div class="col-span-4 lg:col-span-1">
                                <x-forms.toggle-switch-input label="Is recurring?" name="is_recurring" id="is_recurring"
                                    :disabled="$disabled" :checked="$checked" value="selected" />
                            </div>
                            <div class="col-span-4 lg:col-span-3">
                                <div id="dueDateContainer" class="@if ($checked) hidden @endif">
                                    <x-forms.input-group label="Due date" type="date" name="due_date" id="due_date"
                                        placeholder="" :default-value="$task->due_date" :disabled="$disabled" />
                                </div>
                                <div id="recurringDaysContainer"
                                    class="flex flex-wrap gap-2 mt-5 @if (!$checked) hidden @endif">
                                    @foreach ($options as $value => $label)
                                        <x-forms.checkbox-pills-input name="recurring_days[]" :disabled="$disabled"
                                            value="{{ $value }}" id="{{ $value }}"
                                            label="{{ $label }}" :checked="in_array($value, old('recurring_days', [])) ||
                                                in_array($value, $checkedOptions)" />
                                    @endforeach
                                    @error('recurring_days')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex w-full justify-center gap-3 text-center bg-neutral-800/70 mt-7">
                    <a onclick="openModal('deleteModal')" class="btn-red w-1/4 mb-15 mt-8">
                        <i class="fa-solid fa-trash me-0 md:me-1"></i>
                        <p class="hidden md:inline">Delete</p>
                    </a>
                    @if (!$task->is_completed)
                        <button class="btn-blue w-1/4 mb-15 mt-8" type="submit">
                            <i class="fa-solid fa-floppy-disk me-0 md:me-1"></i>
                            <p class="hidden md:inline">Save changes</p>
                        </button>
                        <a onclick="openModal('completeModal')" class="btn-primary w-1/4 mb-15 mt-8">
                            <i class="fa-solid fa-check me-0 md:me-1"></i>
                            <p class="hidden md:inline">Complete</p>
                        </a>
                    @else
                        <a onclick="openModal('reopenModal')" class="btn-warning w-1/4 mb-15 mt-8">
                            <i class="fa-solid fa-backward me-0 md:me-1"></i>
                            <p class="hidden md:inline">Reopen</p>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<x-general.modal id="deleteModal">
    <div class="text-center">
        <i
            class="fa-solid fa-triangle-exclamation text-3xl text-red-600 bg-gradient-to-r from-red-600/15 to-red-700/15 rounded-full p-3"></i>
    </div>
    <div>
        <h3 class="text-xl text-neutral-100 text-center">Are you sure you want to delete the task?</h3>
    </div>
    <div class="flex justify-center gap-3 mb-4 mt-6">
        <form action="{{ route('tasks.destroy', [$task->id]) }}" method="POST">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn-red">
                <i class="fa-solid fa-trash me-0 md:me-1"></i>
                <p class="hidden md:inline">Yes, delete</p>
            </button>
        </form>
        <a onclick="closeModal('deleteModal')" class="btn-secondary">
            <i class="fa-solid fa-ban me-0 md:me-1"></i>
            <p class="hidden md:inline">No, cancel</p>
        </a>
    </div>
</x-general.modal>

@if (!$task->is_completed)
    <x-general.modal id="completeModal">
        <div class="text-center">
            <i
                class="fa-solid fa-check text-3xl text-green-500 bg-gradient-to-r from-lime-400/15 to-green-500/15 rounded-full p-3 px-3.5"></i>
        </div>
        <div>
            <h3 class="text-xl text-neutral-100 text-center">Mark task as completed?</h3>
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
            <a onclick="closeModal('completeModal')" class="btn-secondary">
                <i class="fa-solid fa-ban me-0 md:me-1"></i>
                <p class="hidden md:inline">No, cancel</p>
            </a>
        </div>
    </x-general.modal>
@else
    <x-general.modal id="reopenModal">
        <div class="text-center">
            <i
                class="fa-solid fa-backward text-3xl text-orange-500 bg-gradient-to-r from-amber-400/15 to-orange-400/15 rounded-full p-3 "></i>
        </div>
        <div>
            <h3 class="text-xl text-neutral-100 text-center">Are you sure you want to reopen a task?</h3>
        </div>
        <div class="flex justify-center gap-3 mb-4 mt-6">
            <form action="{{ route('tasks.reopen', [$task->id]) }}" method="POST">
                @method('PATCH')
                @csrf
                <button type="submit" class="btn-warning">
                    <i class="fa-solid fa-check me-0 md:me-1"></i>
                    <p class="hidden md:inline">Yes, reopen</p>
                </button>
            </form>
            <a onclick="closeModal('reopenModal')" class="btn-secondary">
                <i class="fa-solid fa-ban me-0 md:me-1"></i>
                <p class="hidden md:inline">No, cancel</p>
            </a>
        </div>
    </x-general.modal>
@endif

<script>
    const isRecurringBtn = document.querySelector('#is_recurring');
    const recurringDaysContainer = document.querySelector('#recurringDaysContainer');
    const dueDateContainer = document.querySelector('#dueDateContainer');

    isRecurringBtn.addEventListener('click', (event) => {
        if (event.target.checked) {
            recurringDaysContainer.classList.toggle('hidden');
            dueDateContainer.classList.toggle('hidden');
        } else {
            recurringDaysContainer.classList.toggle('hidden');
            dueDateContainer.classList.toggle('hidden');
        }
    })
</script>
