@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge([
        'class' => 'block w-full rounded-md
                    border-navy-100 bg-white text-gray-900
                    focus:border-sky-500 focus:ring-sky-500
                    shadow-sm'
    ]) }}>
