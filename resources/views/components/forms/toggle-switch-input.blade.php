@props(['id', 'name', 'label', 'value', 'checked', 'disabled' => ''])

<div>
    @isset($label)
        <label for="{{ $id }}" class="block text-md text-neutral-200 mb-3 mt-5">{{ $label }}</label>
    @endisset
    <div
        class="flex items-center">
        <div class="@if(!empty($disabled)) opacity-75 @endif relative inline-block w-11 h-5">
            <input {{ $disabled }} @checked($checked) id="{{ $id }}" name="{{ $name }}" value="{{ $value }}" type="checkbox" autocomplete="off"
                class="peer appearance-none w-11 h-5 bg-neutral-900 rounded-full checked:bg-lime-400 cursor-pointer transition-colors duration-300 " />
            <label for="{{ $id }}"
                class="absolute top-0 left-0 w-5 h-5 bg-white rounded-full border border-neutral-300 shadow-lg transition-transform duration-300 peer-checked:translate-x-6 peer-checked:border-lime-600 cursor-pointer">
            </label>
        </div>
    </div>
</div>
