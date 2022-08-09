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
        'postcss-nested': {},
        // tailwindcss: {},
        'postcss-simple-vars': {},
        'postcss-mixins': {},
        'postcss-custom-properties': {},
        'postcss-preset-env': {
            preserve: false,
            autoprefixer: {
                flexbox: 'no-2009',
                grid: true
            },
            stage: 0,
            features: {
                'custom-media-queries': true,
                'nesting-rules': true,
                'custom-properties': false,
                clamp: true
            },
            importFrom: [
                {
                    customMedia: {
                        '--s': '(min-width: 480px)',
                        '--sm': '(min-width: 576px)',
                        '--m': '(min-width: 640px)',
                        '--md': '(min-width: 768px)',
                        '--l': '(min-width: 840px)',
                        '--lg': '(min-width: 992px)',
                        '--xl': '(min-width: 1200px)',
                        '--xxl': '(min-width: 1400px)',
                        '--3xl': '(min-width: 1600px)',
                        '--4xl': '(min-width: 1800px)'
                    }
                }
            ]
        },
        ...(process.env.NODE_ENV === 'production' ? { cssnano: {} } : {})
    }
}
