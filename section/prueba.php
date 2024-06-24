<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8" />
    <title>Historias Clinicas::Login</title>
    <script
      src="https://kit.fontawesome.com/41bcea2ae3.js"
      crossorigin="anonymous"
    ></script>
    <link rel="stylesheet" href="../estilos/style.css" />
    <link rel="shortcut icon" href="/img/logo.png" />
    <!-- icono de la pestaña -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  </head>
  <body id="root">
    <!-- Cabecera de página -->
    <nav>
      <div class="logo">
        <img src="../img/logo.png" alt="logo" />
        <h1>Hospital ******</h1>
      </div>
      <ul>
        <li>
          <a href="/index.html">Inicio</a>
        </li>
        <li>
          <a href="/section/nuevo_paciente.html">Historia clinica</a>
        </li>
        <li>
          <a href="/section/login.html">Iniciar Sesión</a>
        </li>
      </ul>
      <!-- Hamburger al achicar la pantalla -->
      <div class="hamburger">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </div>
    </nav>
    <div class="menubar">
      <ul>
        <li>
          <a href="/">Inicio</a>
        </li>
        <li>
          <a href="#">Historia clinica</a>
        </li>
        <li>
          <a href="../section/login.html">Iniciar Sesión</a>
        </li>
      </ul>
    </div>
    <!--  -->

    <div class="flex container justify-center items-center">
      <div class="form-container">
        <h6>Nuevo Paciente</h6>
        <h4>Datos del paciente</h4>
        <form action="#">
          <div class="grid grid-cols-2 gap-x-4">
            <h6>Nombre</h6>
            <h6>Apellido</h6>
            <input
              type="text"
              class="h-8 rounded-lg border-2 border-solid border-blue-600"
            />
            <input
              type="text"
              class="h-8 rounded-lg border-2 border-solid border-blue-600"
            />
          </div>
          <div class="grid grid-cols-1">
            <h6>Fecha de nacimiento</h6>
            <input
              type="date"
              class="form__input h-8 p-4 rounded-lg border-2 border-solid border-blue-600"
            />
            <h6>Documento de Identidad</h6>
            <div>
              <input
                id="dni"
                type="radio"
                name="document_type"
                value="dni"
              />
              <label for="dni">DNI</label>
              <input
                id="carnet"
                type="radio"
                name="document_type"
                value="carnet"
              />
              <label for="carnet">Carnet de Extranjería</label>
            </div>
            <input
              type="number"
              name="document_number"
              id="document_number"
              class="form__input h-8 p-4 rounded-lg border-2 border-solid border-blue-600"
              placeholder="Ingrese su número de documento"
            />
           
            <div class="grid grid-cols-1 mt-4">
           
              <div>
              <h6>Género</h6>
                <input
                  id="masculino"
                  type="radio"
                  name="genero"
                  value="masculino"
                />
                <label for="masculino">Masculino </label>
              </div>
              <div>
                <input
                  id="femenino"
                  type="radio"
                  name="genero"
                  value="femenino"
                />
                <label for="femenino">Femenino </label>
              </div>
            </div>
          </div>
          <div>
            <h6>Historial Médico</h6>
            <textarea
              name="historial_medico"
              id="historial_medico"
              placeholder="Ej. Hipertensión, Diabetes tipo 2, alergias..."
              class="h-32 rounded-lg border-2 border-solid border-blue-600"
            ></textarea>
          </div>
          <div class="flex justify-end">
            <button class="mr-8" type="submit">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
