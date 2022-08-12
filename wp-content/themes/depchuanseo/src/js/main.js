import '../css/main.scss'

import init from './libs/modules'
document.addEventListener('DOMContentLoaded', () => {
    init({
        module: 'modules'
    }).mount()
})
