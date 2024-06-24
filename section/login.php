  <!DOCTYPE html>
  <html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Historias Clinicas::Login</title>
    <script src="https://kit.fontawesome.com/41bcea2ae3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../estilos/login.css">
    <link rel="shortcut icon" href="/img/logo.png" /> <!-- icono de la pestaña -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="back">
      <a href="../section/index.php"><img src="../img/back.png">
        <p>Regresar</p>
      </a>
    </div>
    <div class="container">
      <div class="content">
        <div class="image-box">
          <img src="../img/login.jpg" alt="">
        </div>
        <form action="../php/login_usuario_be.php" method="POST">
          <div class="topic">Inicia Sesión</div>
          <div class="input-box">
            <input type="text" required name="codigo">
            <label>Ingresa tu código</label>
          </div>
          <div class="input-box">
            <input type="password" required name="pass">
            <label>Ingresa tu contraseña</label>
          </div>
          <div class="input-box">
            <input type="submit" value="Iniciar Sesión">
          </div>
          <button type="button" class="solicitar-codigo-btn">¿Olvidó su contraseña?</button>
        </form>
      </div>
    </div>
  </body>
  </html>