import { addElementWindow } from "./functions.js";

/* --------- SearchBar interaction --------- */

// Origin
const container = ".searcherBtnsContainer";
const buttons = ".search-searcher-row .searcherBtnsContainer .search-select"
let isVuelta = true;

// Cuando cargue el contenido del DOM
document.addEventListener("DOMContentLoaded", (e) => {
    // Abrir cajas para cada button
    addElementWindow(container, buttons);

    // Tipo de búsqueda
    const searchTypeButtons = document.querySelectorAll('.search-type button')

    searchTypeButtons.forEach(button => {
        button.addEventListener('click', e => {
            const vuelta = document.querySelector('#vuelta')
            button.classList.add('active')

            if (button.classList.contains('one-trip')) {
                vuelta.disabled = true;
                vuelta.classList.add('disabled')
                vuelta.querySelector('span input').disabled = true
                isVuelta = true;
            } else {
                vuelta.disabled = false
                vuelta.classList.remove('disabled')
                vuelta.querySelector('span input').disabled = false
                isVuelta = false;
            }

            if (button.nextElementSibling) {
                button.nextElementSibling.classList.remove('active')
            } else {
                button.previousElementSibling.classList.remove('active')
            }
        })
    })

    // Comprobar que al aparacer un submenu que se cierre cuando se haga click fuera de este
    window.addEventListener('click', e => {
        const submenu = document.querySelector('.submenu.active')

        if (submenu) {
            if (!submenu.contains(e.target)) {
                submenu.remove();
            }
        }
    })

    // Mostar calendario
    document.querySelectorAll('.datePicker').forEach(button => {
        button.addEventListener('click', e => {
            button.querySelector('span input').showPicker?.()
        })
    })

    // Limitar vuelta al escoger ida
    if (isVuelta) {
        const vuelta = document.querySelector('#vuelta span input')
        const ida = document.querySelector('#ida span input')

        ida.addEventListener('change', e => {
            vuelta.setAttribute('min', ida.value)
        })
    }

    // Boton para cambiar de entre destino y origen y viceversa
    const changeBtn = document.querySelector('.changeBtn')
    changeBtn.addEventListener('click', e => {
        const origen = changeBtn.previousElementSibling.querySelector('.search-select span p:last-child')
        const destino = changeBtn.nextElementSibling.querySelector('.search-select span p:last-child')

        if (!origen.classList.contains('unselected') && !destino.classList.contains('unselected')) {
            let aux = origen.textContent;
            origen.textContent = destino.textContent
            destino.textContent = aux
        }
    })

    // Poner origen si se le da click a destino
    const origen = changeBtn.previousElementSibling.querySelector('.search-select span p:last-child')
    const destino = changeBtn.nextElementSibling

    destino.addEventListener('click', e => {
        if (origen.classList.contains('unselected')) {
            origen.textContent = 'Málaga' // Esto no es así pendiente de terminar
            origen.classList.remove('unselected')
        }
    })
})