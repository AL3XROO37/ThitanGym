//Header---------------------------------------------
let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.addEventListener('click', () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
});
//FIN HEADER----------------------------------------


//BUSQUEDA CLIENTES
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('search').addEventListener('keyup', function() {
        let query = this.value;

        fetch(`/clientes/buscar?search=${query}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error en la solicitud');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('results').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
    });
});
