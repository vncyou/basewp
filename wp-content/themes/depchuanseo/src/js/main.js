import '../css/main.scss'

import './libs/lazyload'
import './libs/scripts'

import init from './libs/modules'
document.addEventListener('DOMContentLoaded', () => {
    init({
        module: 'modules'
    }).mount()
})
