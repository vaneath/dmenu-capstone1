@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium mb-1']) }}>
    {{ $value ?? $slot }}
</label>
