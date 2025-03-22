@props(['id', 'type' => 'text', 'name', 'label' => null, 'icon' => null, 'defaultValue' => '', 'placeholder' => '', 'disabled' => ''])

<div class="{{ $attributes->get('class') }}">
    @if ($label)
        <label for="{{ $id }}" class="block text-md text-neutral-200 mb-3 mt-5">{{ $label }}</label>
    @endif

    <div
        class="@if(!empty($disabled)) opacity-75 @endif relative flex items-center border-2 border-neutral-700 @error($name) border-red-500 @enderror focus-within:border-lime-400 duration-200 ease-in rounded bg-neutral-800 w-full">
        @if ($icon)
            <span class="absolute left-3 flex items-center text-neutral-500">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
        <input {{ $disabled }} type="{{ $type }}" id="{{ $id }}" name="{{ $name }}" autocomplete="off"
            placeholder="{{ $placeholder }}" value="{{ old($name, $defaultValue) }}"
            class="w-full py-2 bg-neutral-800 text-neutral-200 rounded focus:outline-none focus:ring-2 focus:ring-lime-400 duration-200 ease-in w-full
            @if ($icon) pl-10 @else px-4 @endif">
    </div>

    @error($name)
        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
    @enderror
</div>
