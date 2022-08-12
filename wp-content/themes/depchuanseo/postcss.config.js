const resolver = require('postcss-import-resolver')
const path = require('path')

module.exports = {
    parser: 'postcss-scss',
    plugins: {
        'postcss-import': {
            resolve: resolver({
                alias: {
                    '~modules': path.resolve(__dirname, 'modules')
                }
            })
        },
        'postcss-mixins': {},
        'postcss-advanced-variables': {},
        'tailwindcss/nesting': 'postcss-nested',
        tailwindcss: {},
        autoprefixer: {},
        ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {})
    }
}
