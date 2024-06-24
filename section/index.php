<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Historias Clínicas</title>
    <script
      src="https://kit.fontawesome.com/41bcea2ae3.js"
      crossorigin="anonymous"
    ></script>
    <link
      rel="stylesheet"
      type="text/css"
      target="_blank"
      href="../estilos/style.css"
    />
    <link rel="shortcut icon" href="/img/logo.png" />
    <!-- icono de la pestaña -->
  </head>
  <body>
    <?php  
    include("header.php");
    ?>
    <!-- Cabecera de página -->
    <!--<nav>
      <div class="logo">
        <img src="../img/logo.png" alt="logo" />
        <h1>Hospital ******</h1>
      </div>
      <ul>
         <li>
          <a href="/index.html">Inicio</a>
        </li>
        <li>
          <a href="../section/prueba.php">Historia clinica</a>
        </li>
        <li>
          <a href="../section/login.php">Iniciar Sesión</a>
        </li>
      </ul>
      Hamburger al achicar la pantalla 
      <div class="hamburger">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </div>
    </nav>
    <div class="menubar">
      <ul>
        <li>
          <a href="#">Inicio</a>
        </li>
        <li>
          <a href="#">Historia clinica</a>
        </li>
        <li>
          <a href="../section/login.php">Iniciar Sesión</a>
        </li>
      </ul>
    </div>-->
    <!-- Imagen inicial -->
    <section class="hero-section">
      <div class="content">
        <h2>Registro Digital de Historias Clinicas</h2>
        <p>
          Bienvenido al Registro Digital de Historias Clínicas, una herramienta
          revolucionaria diseñada para simplificar y mejorar la gestión de tu
          historial médico.
        </p>
        <a href="../section/login.php"  style="color:#FF0000;" ><button>Iniciar Sesión</button></a>
      </div>
    </section>
    <div class="container-footer">
    <?php  
    include("footer.php");
    ?>
      <!-- Pie de página 
      <footer>
        <div class="logo-footer">
          <img src="../img/logo.png" alt="" />
        </div>
        <div class="descripcion">
          <p>
            En nuestro hospital, nos dedicamos a brindar atención médica
            integral de la más alta calidad, con un enfoque centrado en el
            paciente y en la calidez humana.
          </p>
        </div>
        <div class="redes-footer">
          <a href="#" style="text-decoration: none"
            ><i class="fab fa-facebook-f icon-redes-footer"></i
          ></a>
          <a href="#" style="text-decoration: none"
            ><i class="fa-solid fa-envelope icon-redes-footer"></i
          ></a>
          <a href="#" style="text-decoration: none"
            ><i class="fab fa-instagram icon-redes-footer"></i
          ></a>
        </div>
        <hr />
        <h4>
          © 2024 Registro Digital de Historias Clinicas - Todos los Derechos
          Reservados
        </h4>
      </footer>-->
    </div>

    <script src="js/script.js"></script>
  </body>
</html>
