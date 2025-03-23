<header class="bg-neutral-950/25 shadow backdrop-blur-md sticky top-0 z-50">
    <div class="max-w-screen-xl mx-auto px-4 py-4.5 flex justify-between items-center">
        <x-general.logo width="127px" name="logo-header" />
        <nav class="hidden md:block">
            <ul class="flex space-x-6 text-white">
                <li><a href="{{ route('tasks.index') }}" class="hover:text-lime-400 duration-200 ease-in">Tasks</a></li>
                <li><a href="{{ route('users.edit', auth()->id()) }}" class="hover:text-lime-400 duration-200 ease-in">Hi,
                        {{ explode(' ', auth()->user()->name)[0] }} </a></li>
                <li><a href="{{ route('tasks.create') }}" class="btn-primary"><i class="fa-solid fa-plus me-1.5"></i>New
                        task</a></li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="hover:text-lime-400 duration-200 ease-in cursor-pointer" type="submit"><i
                            class="fa-solid fa-arrow-right-from-bracket"></i></button>
                </form>
            </ul>
        </nav>
        {{-- mobile navigation --}}
        <div class="flex me-4 items-center gap-5 sm:gap-9 md:hidden text-white">
            <a class="btn-primary" href="{{ route('tasks.create') }}">
                <i class="fa-solid fa-plus"></i>
            </a>
            <a class="text-lg text-neutral-200 hover:text-lime-400 duration-200 ease-in"
                href="{{ route('users.edit', auth()->id()) }}">
                <i class="fa-solid fa-user"></i>
            </a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-lg cursor-pointer text-neutral-200 hover:text-lime-400 duration-200 ease-in" type="submit">
                    <i class="fa-solid fa-arrow-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>
</header>
