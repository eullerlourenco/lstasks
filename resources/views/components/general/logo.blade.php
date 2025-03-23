@props(['width' => '', 'height' => '', 'name' => 'logo'])

<div class="flex justify-center">
    <a href="{{ route('tasks.index') }}" class="text-gradient duration-200 ease-in text-3xl font-bold">
        <img height="{{ $height }}" width="{{ $width }}" src="{{ Vite::asset('resources/images/app/' . $name . '.png') }}" alt="{{ config('app.name') }}"
        class="{{ $attributes->get('class') }}" >
    </a>
</div>
