@props(['id', 'type' => 'text', 'name', 'label' => null, 'options', 'defaultValue' => '', 'placeholder' => ''])

<div class="{{ $attributes->get('class') }}">
    @if ($label)
        <label for="{{ $id }}" class="block text-md text-neutral-200 mb-3 mt-5">{{ $label }}</label>
    @endif

    <div class="flex items-center border-2 border-neutral-700 @error($name) border-red-500 @enderror focus-within:border-lime-400 duration-200 ease-in rounded w-full">
        <select name="{{ $name }}" id="{{ $id }}"
            class="px-4 py-2.5 text-neutral-300 rounded bg-neutral-800 focus:outline-none focus:ring-2 focus:ring-lime-400 duration-200 ease-in w-full">
            <option disabled selected>{{ $placeholder }}</option>
            @foreach ($options as $value => $option)
                <option value="{{ $value }}" @selected($value === $defaultValue) class="text-neutral-200">
                    {{ $option }}
                </option>
            @endforeach
        </select>
    </div>

    @error($name)
        <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
    @enderror
</div>
