@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'rounded-md bg-sky-100 border border-sky-300 px-4 py-3 text-sm font-medium text-success']) }}>
        {{ $status }}
    </div>
@endif
