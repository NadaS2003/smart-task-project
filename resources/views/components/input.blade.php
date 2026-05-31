@props([
    'name',
    'label',
    'type' => 'text',
    'placeholder' => '',
    'value' => ''
])

<div class="space-y-base">
    <label for="{{ $name }}" class="font-label-md text-label-md text-secondary uppercase tracking-wider block">
        {{ $label }}
    </label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ $name }}"
        value="{{ old($name, $value) }}"
        placeholder="{{ $placeholder }}"
        {{ $attributes->merge(['class' => 'w-full bg-[#F1F5F9] border-none rounded-lg px-md py-md font-body-lg text-body-lg text-on-surface placeholder:text-outline transition-all focus:outline-none focus:border-primary focus:bg-white']) }}
    >
</div>
