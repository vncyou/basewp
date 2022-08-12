module.exports = {
    content: [
        './src/**/*.js',
        './module/**/*.{js,php,html}',
        './partials/**/*.{js,php,html}',
        './templates/**/*.{js,php,html}',
        './**/*.{php,html}'
    ],
    darkMode: 'class',
    theme: {
        screens: {
            xs: '480px',
            s: '576px',
            sm: '640px',
            m: '768px',
            md: '840px',
            ml: '840px',
            l: '1200px',
            lg: '1400px',
            xl: '1600px',
            '2xl': '1800px',
            '3xl': '2000px'
        },
        aspectRatio: {},
        extend: {}
    },
    variants: {},
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
        require('@tailwindcss/line-clamp'),
        require('@tailwindcss/aspect-ratio')
    ]
}
