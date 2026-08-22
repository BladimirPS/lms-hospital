@props(['value'])

<label {{ $attributes->merge(['class' => 'block text-sm font-medium text-navy-500']) }}>
    {{ $value ?? $slot }}
</label>
