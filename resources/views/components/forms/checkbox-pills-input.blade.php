@props(['id', 'name', 'label', 'icon' => null, 'value', 'checked' => false, 'disabled' => ''])

<div>
    <input {{ $disabled }} @checked($checked) type="checkbox" id="{{ $id }}" name="{{ $name }}"
        value="{{ $value }}" class="hidden peer" autocomplete="off">
    <label for="{{ $id }}"
        class="@if(!empty($disabled)) opacity-75 @endif inline-flex items-center justify-between px-2 py-0.5 text-neutral-400 border-1 border-transparent bg-neutral-700/30 rounded-full cursor-pointer 
        hover:text-lime-400 peer-checked:text-lime-400 peer-checked:bg-lime-400/25 hover:bg-lime-400/35 duration-200 ease-in">
        <div class="block">
            @if ($icon)
                <i class="{{ $icon }}"></i>
            @endif
            <span class="tex font-medium">{{ $label }}</span>
        </div>
    </label>
</div>
