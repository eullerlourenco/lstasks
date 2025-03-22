@props([
    'label' => null,
    'id' => null,
    'name' => null,
    'placeholder' => '',
    'rows' => 4,
    'cols' => 50,
    'icon' => null,
    'defaultValue' => '',
    'disabled' => ''
])

<div>
    @if ($label)
        <label for="{{ $id }}" class="block text-md text-neutral-200 mb-3 mt-5">{{ $label }}</label>
    @endif
    <div
        class="@if(!empty($disabled)) opacity-75 @endif relative flex items-center border-2 border-neutral-700 @error($name) border-red-500 @enderror focus-within:border-lime-400 rounded">
        @if ($icon)
            <span class="absolute left-3 text-gray-500">
                <i class="{{ $icon }}"></i>
            </span>
        @endif
        <textarea {{ $disabled }} autocomplete="off" name="{{ $name }}" id="{{ $id }}" placeholder="{{ $placeholder }}"
            rows="{{ $rows }}" cols="{{ $cols }}"
            class="px-4 py-2 resize-y w-full text-neutral-200 rounded bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-lime-400 duration-200 ease-in 
                   @if ($icon) pl-10 @endif
                   @error($name) border-red-500 @enderror">{{ old($name, $defaultValue) }}</textarea>
    </div>

    @error($name)
        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
    @enderror
</div>
