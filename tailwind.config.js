/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
    ],
    safelist: [
        'article-content',
    ],
    theme: {
        extend: {
            colors: {
                'hgo-primary':   '#1A3A5C',
                'hgo-secondary': '#2E74B5',
                'hgo-success':   '#27AE60',
                'hgo-warning':   '#E67E22',
                'hgo-danger':    '#E74C3C',
            }
        }
    },
    plugins: [
        require('@tailwindcss/typography'),
    ],
}
