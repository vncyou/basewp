import '../css/main.css'

import init from './libs/modules'
document.addEventListener('DOMContentLoaded', () => {
    init({
        module: 'modules'
    }).mount()
})
