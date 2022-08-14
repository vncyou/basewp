import './mmenu-light'

document.addEventListener(
    'DOMContentLoaded', () => {
        const menu = new MmenuLight(
            document.querySelector('.menu-main-menu-container')
        )

        menu.navigation()
        const drawer = menu.offcanvas()

        document.querySelector('a[href="#primary-menu"]')
            .addEventListener('click', (evnt) => {
                evnt.preventDefault()
                drawer.open()
            })
    }
)
