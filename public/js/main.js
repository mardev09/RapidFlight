import { addElementWindow } from "./functions.js";

/* --------- SearchBar interaction --------- */

// Origin
const container = ".searcherBtnsContainer";
const buttons = ".search-searcher-row .searcherBtnsContainer .search-select"
let isVuelta = true;

// Cuando cargue el contenido del DOM
document.addEventListener("DOMContentLoaded", (e) => {
    // Imagenes del carrousel
    const carousel = document.querySelectorAll('.pop-dests-carousel .carousel-dest')

    carousel.forEach(box => {
        const city = box.querySelector('.carousel-header p:last-child').textContent.trim();

        if (window.rapidFlightConfig && window.rapidFlightConfig.unsplashKey && window.rapidFlightConfig.unsplashKey !== 'YOUR_UNSPLASH_ACCESS_KEY_HERE') {
            fetch(`https://api.unsplash.com/search/photos?page=1&query=${encodeURIComponent(city + ' city')}&client_id=${window.rapidFlightConfig.unsplashKey}&orientation=landscape`)
                .then(res => res.json())
                .then(data => {
                    if (data.results && data.results.length > 0) {
                        box.style.backgroundImage = `url('${data.results[0].urls.regular}&w=1600&q=80')`;
                    } else {
                        // Fallback - Use a placeholder service
                        box.style.backgroundImage = `url('https://placehold.co/600x400?text=${encodeURIComponent(city)}')`;
                    }
                })
                .catch(err => {
                    console.error('Error fetching image for ' + city, err);
                    box.style.backgroundImage = `url('https://placehold.co/600x400?text=${encodeURIComponent(city)}')`;
                });
        } else {
            // Fallback if no key or default key
            box.style.backgroundImage = `url('https://placehold.co/600x400?text=${encodeURIComponent(city)}')`;
        }
    });


    // Abrir cajas para cada button
    addElementWindow(container, buttons);

    // Tipo de búsqueda
    const searchTypeButtons = document.querySelectorAll('.search-type button')

    searchTypeButtons.forEach(button => {
        button.addEventListener('click', e => {
            const container = button.closest('.search-type');
            if (container) {
                container.querySelectorAll('button').forEach(btn => btn.classList.remove('active'));
            }
            button.classList.add('active');

            const vuelta = document.querySelector('#vuelta');
            const vueltaInput = vuelta?.querySelector('span input');
            
            if (!vuelta || !vueltaInput) return;

            if (button.classList.contains('one-trip')) {
                vuelta.disabled = true;
                vuelta.setAttribute('data-disabled', 'true');
                vuelta.classList.add('disabled')
                vueltaInput.disabled = true
                vueltaInput.setAttribute('data-disabled', 'true');
                isVuelta = true;
                // Deshabilitar flatpickr específicamente para el input de vuelta
                if (vueltaInput._flatpickr) {
                    vueltaInput._flatpickr.close();
                    vueltaInput._flatpickr.disable();
                    // También deshabilitar el altInput si existe
                    const altInput = vueltaInput._flatpickr.altInput;
                    if (altInput) {
                        altInput.disabled = true;
                        altInput.readOnly = true;
                        altInput.style.pointerEvents = 'none';
                        altInput.style.cursor = 'not-allowed';
                        altInput.setAttribute('data-disabled', 'true');
                        altInput.setAttribute('tabindex', '-1');
                        // Remover cualquier listener de flatpickr en el altInput
                        altInput.onclick = function (e) {
                            e.preventDefault();
                            e.stopPropagation();
                            return false;
                        };
                    }
                }
            } else {
                vuelta.disabled = false
                vuelta.removeAttribute('data-disabled');
                vuelta.classList.remove('disabled')
                vueltaInput.disabled = false
                vueltaInput.removeAttribute('data-disabled');
                isVuelta = false;
                // Habilitar flatpickr cuando se vuelve a "ida y vuelta"
                if (vueltaInput._flatpickr) {
                    vueltaInput._flatpickr.enable();
                    // También habilitar el altInput si existe
                    const altInput = vueltaInput._flatpickr.altInput;
                    if (altInput) {
                        altInput.disabled = false;
                        altInput.readOnly = true; // Mantener readonly porque es altInput
                        altInput.style.pointerEvents = '';
                        altInput.style.cursor = 'pointer';
                        altInput.removeAttribute('data-disabled');
                        altInput.setAttribute('tabindex', '0');
                        altInput.onclick = null; // Restaurar comportamiento por defecto
                    }
                }
            }
        })
    })

    // Comprobar que al aparacer un submenu que se cierre cuando se haga click fuera de este
    window.addEventListener('click', e => {
        const submenu = document.querySelector('.submenu.active')
        const navBox = document.querySelector('.navAccountBox')
        const showAccountSubmenu = document.querySelector('#showAccountSubmenu')

        if (showAccountSubmenu.contains(e.target)) {
            if (navBox.classList.contains('active')) {
                navBox.classList.remove('active')
            } else {
                navBox.classList.add('active')
            }
        } else {
            if (navBox.classList.contains('active')) {
                if (!navBox.contains(e.target)) {
                    navBox.classList.remove('active')
                }
            }
        }

        if (submenu) {
            if (!submenu.contains(e.target)) {
                submenu.remove();
            }
        }

        // Hammenu check
        const ham = document?.querySelector(".subnav")
        const hamButton = document?.querySelector(".hamMenu")

        if (ham.classList.contains("active")) {
            if (!ham.contains(e.target) && !hamButton.contains(e.target)) {
                ham.classList.remove('active')
                document.body.style.overflow = 'unset';
            }
        }
    })

    // Prevenir que se abra el calendario si el botón está deshabilitado
    document.querySelectorAll('.datePicker').forEach(button => {
        // Listener con alta prioridad para prevenir eventos en botones deshabilitados
        button.addEventListener('click', e => {
            if (button.disabled || button.classList.contains('disabled')) {
                e.preventDefault();
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
            }
        }, true); // Usar capture phase para ejecutarse antes que otros listeners

        // Listener para mostrar calendario nativo
        button.addEventListener('click', e => {
            const input = button.querySelector('span input');
            // Verificar que ni el input ni el botón estén deshabilitados
            if (!input.disabled && !button.disabled && !button.classList.contains('disabled')) {
                input.showPicker?.()
            }
        })
    })

    // Limitar vuelta al escoger ida
    if (isVuelta) {
        const vuelta = document.querySelector('#vuelta span input')
        const ida = document.querySelector('#ida span input')

        ida?.addEventListener('change', e => {
            vuelta.setAttribute('min', ida.value)
        })
    }

    // Boton para cambiar de entre destino y origen y viceversa
    const changeBtn = document?.querySelector('.changeBtn')
    changeBtn?.addEventListener('click', e => {
        const origen = changeBtn.previousElementSibling.querySelector('.search-select span p:last-child')
        const destino = changeBtn.nextElementSibling.querySelector('.search-select span p:last-child')

        if (!origen.classList.contains('unselected') && !destino.classList.contains('unselected')) {
            let aux = origen.textContent;
            origen.textContent = destino.textContent
            destino.textContent = aux
        }
    })

    // Poner origen si se le da click a destino
    const origen = changeBtn?.previousElementSibling.querySelector('.search-select span p:last-child')
    const destino = changeBtn?.nextElementSibling

    destino?.addEventListener('click', e => {
        if (origen.classList.contains('unselected')) {
            origen.textContent = 'Albacete'
            origen.classList.remove('unselected')
        }
    })

    // Toggle del boton del nav para el submenu de cuenta y cerrar sesion
    document.querySelector('#showAccountSubmenu')?.addEventListener('click', e => {

    })

    // Ham menu
    document.querySelector(".hamMenu")?.addEventListener('click', e => {
        const ham = document.querySelector('.subnav')

        if (ham.classList.contains("active")) {
            ham.classList.remove('active')
            document.body.style.overflow = 'unset';
        } else {
            ham.classList.add('active')
            document.body.style.overflow = 'hidden';
        }
    })

    // Close ham button
    document.querySelector(".exitHam")?.addEventListener('click', e => {
        const ham = document.querySelector('.subnav')

        ham.classList.remove('active')
        document.body.style.overflow = 'unset';
    })
})