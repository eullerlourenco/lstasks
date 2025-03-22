<div class="flex items-start justify-center">
    <div class="w-full md:w-2/3 lg:w-4/7 bg-neutral-800 shadow-xl rounded-3xl overflow-hidden">
        <form action="{{ route('tasks.store') }}" method="POST">
            <div class="flex flex-col items-center">
                <div class="mb-7 w-full bg-neutral-950/20 py-6">
                    <h2 class="text-neutral-200 font-normal text-center text-4xl">
                        Create your task
                    </h2>
                </div>
                <div class="w-full md:w-4/5 px-5 bg-neutral-800/50">
                    @csrf
                    <div class="grid gap-y-4">
                        <x-forms.input-group type="text" name="title" id="title" placeholder="Title" />
                        <x-forms.textarea-input rows="6" name="description" id="description"
                            placeholder="Description" />
                        <div class="grid grid-cols-4">
                            @php
                                $checked = old('is_recurring') ? true : false;
                            @endphp
                            <div class="col-span-4 lg:col-span-1">
                                <x-forms.toggle-switch-input label="Is recurring?" name="is_recurring" id="is_recurring"
                                    :checked="$checked" value="selected" />
                            </div>
                            <div class="col-span-4 lg:col-span-3">
                                <div id="dueDateContainer" class="@if ($checked) hidden @endif">
                                    <x-forms.input-group label="Due date" type="date" name="due_date" id="due_date"
                                        placeholder="" :default-value="date('Y-m-d')" />
                                </div>
                                <div id="recurringDaysContainer"
                                    class="flex flex-wrap gap-2 mt-5 @if (!$checked) hidden @endif">
                                    @foreach ($options as $value => $label)
                                        <x-forms.checkbox-pills-input name="recurring_days[]"
                                            value="{{ $value }}" id="{{ $value }}"
                                            label="{{ $label }}" />
                                    @endforeach
                                    @error('recurring_days')
                                        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full text-center bg-neutral-800/70 mt-7">
                    <button class="btn-primary w-3/4 mb-15 mt-8" type="submit">
                        <i class="fa-solid fa-plus me-1"></i>
                        Create
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

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
