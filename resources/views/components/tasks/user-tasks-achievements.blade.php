<div>
    <div>
        <p class="text-3xl text-neutral-200 pb-5 border-b border-neutral-600 mb-5">Tasks achievements</p>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-3 gap-y-5">

        <div class="grid gap-2 bg-neutral-900/20 border border-neutral-700 shadow-xl rounded-xl p-4">
            <div class="grid items-center grid-cols-4 gap-2">
                <div class="col-span-1">
                    <i class="fa-solid fa-check text-2xl bg-gradient-to-r from-green-400/15 to-green-700/15 col-span-1 p-2 px-2.5 rounded-full text-green-400"></i>
                </div>
                <p class="col-span-3 text-lg/6 font-normal text-green-400">Completed tasks</p>
            </div>
            <div class="text-end">
                <p class="text-neutral-200 text-2xl font-light">{{ $completedTasks }}</p>
            </div>
        </div>

        <div class="grid gap-2 bg-neutral-900/20 border border-neutral-700 shadow-xl rounded-xl p-4">
            <div class="grid items-center grid-cols-4 gap-2">
                <div class="col-span-1">
                    <i class="fa-solid fa-clock text-2xl bg-gradient-to-r from-amber-400/15 to-amber-700/15 col-span-1 p-2 rounded-full text-amber-400"></i>
                </div>
                <p class="col-span-3 text-lg/6 font-normal text-amber-400">Pending tasks</p>
            </div>
            <div class="text-end">
                <p class="text-neutral-200 text-2xl font-light">{{ $tasksToDo }}</p>
            </div>
        </div>

        <div class="grid gap-2 bg-neutral-900/20 border border-neutral-700 shadow-xl rounded-xl p-4">
            <div class="grid items-center grid-cols-4 gap-2">
                <div class="col-span-1">
                    <i class="fa-solid fa-xmark text-2xl bg-gradient-to-r from-red-500/15 to-red-700/15 col-span-1 p-2 px-3 rounded-full text-red-500"></i>
                </div>
                <p class="col-span-3 text-lg/6 font-normal text-red-500">Overdue tasks</p>
            </div>
            <div class="text-end">
                <p class="text-neutral-200 text-2xl font-light">{{ $overdueTasks }}</p>
            </div>
        </div>

        <div class="grid gap-2 bg-neutral-900/20 border border-neutral-700 shadow-xl rounded-xl p-4">
            <div class="grid items-center grid-cols-4 gap-2">
                <div class="col-span-1">
                    <i class="fa-solid fa-calendar-day text-2xl bg-gradient-to-r from-teal-500/15 to-teal-700/15 col-span-1 p-2 px-2.75 rounded-full text-teal-500"></i>
                </div>
                <p class="col-span-3 text-lg/6 font-normal text-teal-500">Completed current week</p>
            </div>
            <div class="text-end">
                <p class="text-neutral-200 text-2xl font-light">{{ $completedCurrentWeek }}</p>
            </div>
        </div>

        <div class="grid gap-2 bg-neutral-900/20 border border-neutral-700 shadow-xl rounded-xl p-4">
            <div class="grid items-center grid-cols-4 gap-2">
                <div class="col-span-1">
                    <i class="fa-solid fa-calendar-week text-2xl bg-gradient-to-r from-fuchsia-500/15 to-fuchsia-700/15 col-span-1 p-2 px-2.75 rounded-full text-fuchsia-500"></i>
                </div>
                <p class="col-span-3 text-lg/6 font-normal text-fuchsia-500">Completed current month</p>
            </div>
            <div class="text-end">
                <p class="text-neutral-200 text-2xl font-light">{{ $completedCurrentMonth }}</p>
            </div>
        </div>

        <div class="grid gap-2 bg-neutral-900/20 border border-neutral-700 shadow-xl rounded-xl p-4">
            <div class="grid items-center grid-cols-4 gap-2">
                <div class="col-span-1">
                    <i class="fa-solid fa-calendar-days text-2xl bg-gradient-to-r from-blue-500/15 to-blue-700/15 col-span-1 p-2 px-2.75 rounded-full text-blue-500"></i>
                </div>
                <p class="col-span-3 text-lg/6 font-normal text-blue-500">Completed current year</p>
            </div>
            <div class="text-end">
                <p class="text-neutral-200 text-2xl font-light">{{ $completedCurrentYear }}</p>
            </div>
        </div>

    </div>
</div>