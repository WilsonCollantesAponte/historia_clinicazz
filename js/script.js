// Archivo: script.js

// Funcionalidad para mostrar las secciones en el contenido
document.addEventListener('DOMContentLoaded', function() {
  const links = document.querySelectorAll('.sidebar ul li a');
  const content = document.getElementById('content');

  links.forEach(link => {
      link.addEventListener('click', function(event) {
          event.preventDefault();
          const target = link.getAttribute('data-target');

          // Hacer una solicitud AJAX para cargar el contenido
          fetch(target)
              .then(response => response.text())
              .then(html => {
                  content.innerHTML = html;
              })
              .catch(error => {
                  console.error('Error al cargar el contenido:', error);
              });
      });
  });
});

// Funcionalidad para el menú de hamburguesa en pantallas móviles
const mobileNav = document.querySelector(".hamburger");
const navbar = document.querySelector(".menubar");

const toggleNav = () => {
navbar.classList.toggle("active");
mobileNav.classList.toggle("hamburger-active");
};

// Agrega un evento de clic al ícono del hamburguesa para abrir y cerrar el menú
mobileNav.addEventListener('click', toggleNav);

document.addEventListener("DOMContentLoaded", function() {
  var dropdownToggles = document.querySelectorAll(".dropdown-toggle");

  dropdownToggles.forEach(function(toggle) {
      toggle.addEventListener("click", function(e) {
          e.preventDefault();
          var dropdownMenu = this.nextElementSibling;
          dropdownMenu.classList.toggle("show");
      });   
  });

  document.addEventListener('DOMContentLoaded', (event) => {
    document.getElementById('logoutButton').addEventListener('click', function() {
        window.location.href = '../php/logout.php';
    });

    document.getElementById('logoutButton').addEventListener('click', function() {
        window.location.href = '../php/logout.php';
    });

    function restrictAccessByRole(role) {
        const sidebarMenu = document.getElementById('sidebarMenu');
        if (role == 1) {
            sidebarMenu.innerHTML = `
                <li><a href="#" data-target="../section/nuevo_paciente.php">Nuevo paciente</a></li>
                <li class="dropdown">
                    <p class="dropdown-toggle">Formatos de historias clínicas</p>
                    <ul class="dropdown-menu">
                        <li><a href="#" data-target="../section/HistoriaEmergencia.php">Formato de emergencia</a></li>
                        <li><a href="#" data-target="../section/formato_consulta_externa.php">Formato de consulta externa</a></li>
                        <li><a href="#" data-target="../section/formato_hospitalizacion.php">Formato de hospitalización</a></li>
                        <li><a href="#" data-target="../section/ficha_familiar.php">Ficha familiar</a></li>
                    </ul>
                </li>
                <li><a href="#" data-target="../section/registros_pacientes.php">Registros de pacientes</a></li>
            `;
        } else if (role == 2) {
            sidebarMenu.innerHTML = `
                <li><a href="#" data-target="../section/nuevo_paciente.php">Nuevo paciente</a></li>
            `;
        } else if (role == 3) {
            sidebarMenu.innerHTML = `
                <li class="dropdown">
                    <p class="dropdown-toggle">Formatos de historias clínicas</p>
                    <ul class="dropdown-menu">
                        <li><a href="#" data-target="../section/HistoriaEmergencia.php">Formato de emergencia</a></li>
                    </ul>
                </li>
            `;
        } else if (role == 4) {
            sidebarMenu.innerHTML = `
                <li><a href="#" data-target="../section/registros_pacientes.php">Registros de pacientes</a></li>
            `;
        }
    }

    restrictAccessByRole(userRole);

   //EMERGENCIA SCRIPT

   document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('emergencyForm');
    const fechaNacimiento = document.getElementById('fechaNacimiento');
    const edad = document.getElementById('edad');

    fechaNacimiento.addEventListener('change', function () {
        const today = new Date();
        const birthDate = new Date(this.value);
        let age = today.getFullYear() - birthDate.getFullYear();
        const m = today.getMonth() - birthDate.getMonth();
        if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
            age--;
        }
        edad.value = age;
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        alert('Historia Clínica Guardada');
        form.reset();
    });
});









});

});



