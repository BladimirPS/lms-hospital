@props(['type' => 'submit'])

<button {{ $attributes->merge([
        'type' => $type,
        'class' => 'inline-flex items-center justify-center gap-2 px-4 py-2
                    bg-navy-500 hover:bg-navy-700 active:bg-navy-900
                    border border-transparent rounded-md
                    font-semibold text-sm text-white uppercase tracking-widest
                    transition ease-in-out duration-150
                    focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2
                    disabled:opacity-50'
    ]) }}>
    {{ $slot }}
</button>
