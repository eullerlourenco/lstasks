<div class="mb-4">
    <form action="{{ route('tasks.index') }}" method="GET">
        <div class="flex flex-row pb-4 items-center justify-start gap-2">
            <a class="btn-secondary" onclick="openModal('filterModal')">
                <i class="fa-solid fa-filter me-1"></i>
                Filters
            </a>
        </div>
    </form>
</div>

<x-general.modal id="filterModal">
    <div class="text-end">
        <a onclick="closeModal('filterModal')">
            <i
                class="fa-solid fa-xmark text-2xl text-neutral-500 cursor-pointer hover:text-neutral-700 duration-200 ease-in">
            </i>
        </a>
    </div>
    <div class="text-center">
        <i
            class="fa-solid fa-filter text-3xl text-neutral-300 bg-gradient-to-r from-neutral-400/15 to-neutral-600/15 rounded-full p-3"></i>
    </div>
    <div>
        <h3 class="text-xl text-neutral-100 text-center mb-2">Filter a task</h3>
    </div>
    <div>
        <form action="{{ route('tasks.index') }}" method="GET">
            <div class="flex flex-row flex-wrap pb-4 items-center justify-start gap-2">
                <div class="flex gap-3 flex-wrap">
                    <span class="text-neutral-300 w-full">Due date range:</span>
                    <x-forms.input-group type="date" name="startDate" id="startDate" :default-value="$startDate" />
                    <span class="text-neutral-300 w-full md:w-auto">to</span>
                    <x-forms.input-group type="date" name="endDate" id="endDate" :default-value="$endDate" />
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 flex-wrap w-full">
                    <div class="col-span-1 flex flex-wrap gap-3">
                        <x-forms.select-input name="status" id="status" placeholder="Choose a status"
                            label="Task status:" :options="['all' => 'All', 'pending' => 'Pending', 'completed' => 'Completed']" :default-value="$status" class="w-full" />
                    </div>
                    <div class="col-span-1 flex flex-wrap gap-3">
                        <x-forms.select-input name="type" id="type" placeholder="Choose a type"
                            label="Task type:" :options="['all' => 'All', 'recurring' => 'Recurring', 'fixed' => 'Fixed']" :default-value="$type" class="w-full" />
                    </div>
                </div>
                <div class="flex w-full">
                    <x-forms.input-group type="text" name="keyword" id="keyword" placeholder="Search for a task..."
                        label="Search by keyword:" class="w-full" :default-value="$keyword" />
                </div>
                <div class="w-full text-end mt-5">
                    <a class="btn-secondary inline-block!" href="{{ route('tasks.index') }}">
                        <i class="fa-solid fa-trash me-1"></i>
                        Clear
                    </a>
                    <button class="btn-primary" type="submit">
                        <i class="fa-solid fa-magnifying-glass me-1"></i>
                        Apply
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-general.modal>
