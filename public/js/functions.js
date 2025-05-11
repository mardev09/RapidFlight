export const addElementWindow = (containerQuery, buttonsQuery) => {
    const buttons = document.querySelectorAll(buttonsQuery)
    
    buttons.forEach(button => {

        button.addEventListener('click', (e) => {
            if (!button.parentElement.querySelector(`.${button.dataset.window}`)) {
                const container = button.closest(containerQuery)
                const template = document.querySelector(`#${button.dataset.window}`)
                const select = document.importNode(template.content, true)
                select.querySelector(`.${button.dataset.window}`).classList.add('active');
                setTimeout(() => {
                    container.appendChild(select);
                    const submenu = document.querySelector('.submenu.active')

                    // Poner en focus el la ciudad que este seleccionada si lo está
                    if (!submenu.closest('.searcherBtnsContainer').querySelector('.search-select span p:last-child').classList.contains('unselected')) {
                        const ciudadSeleccionada = submenu.closest('.searcherBtnsContainer').querySelector('.search-select span p:last-child').textContent
                        submenu.querySelectorAll('.cities button').forEach(button => {
                            if (ciudadSeleccionada == button.querySelector('p:first-child').textContent) {
                                button.classList.add('active')
                            }
                        })
                    }

                    // Comprobar que al clickear uno de los botones, su valor se asigne al boton principal
                    submenu.querySelectorAll('.cities button').forEach(button => {
                        button.addEventListener('click', e => {
                            submenu.closest('.searcherBtnsContainer').querySelector('.search-select span p:last-child').textContent = button.querySelector('p:first-child').textContent
                            submenu.closest('.searcherBtnsContainer').querySelector('.search-select span p:last-child').classList.remove('unselected')
                            submenu.remove();
                        })
                    })

                    // El contador de pasajeros
                    submenu.querySelectorAll('.passenger .counter .counterButton').forEach(button => {
                        
                        button.addEventListener('click', e => {
                            let val = submenu.closest('.searcherBtnsContainer').querySelector('.search-select span p:last-child')
                            let p;
                            let aux = "";
                            
                            if (button.id == 'counterMore') {
                                p = button.nextElementSibling
                                if (Number(p.textContent) < 9) p.textContent = Number(p.textContent) + 1
                            } else {
                                p = button.previousElementSibling
                                if (Number(p.textContent) > 1) p.textContent = Number(p.textContent) - 1
                            }

                            aux = p.textContent.toString() + val.textContent.substring(1)
                            val.textContent = aux
                        })
                    })
                }, 0)
            } 
        })
    });
}