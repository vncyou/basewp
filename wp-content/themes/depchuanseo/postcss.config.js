const resolver = require('postcss-import-resolver')
const path = require('path')

module.exports = {
    plugins: {
        'postcss-import': {
            resolve: resolver({
                alias: {
                    '~modules': path.resolve(__dirname, 'modules')
                }
            })
        },
        'tailwindcss/nesting': 'postcss-nesting',
        tailwindcss: {},
        'postcss-simple-vars': {},
        'postcss-mixins': {},
        autoprefixer: {},
        ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {})
    }
}
