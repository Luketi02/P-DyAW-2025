<?php
// Inicializamos arreglo de errores
$errores = [];

function limpiar($dato) {
  return htmlspecialchars(stripslashes(trim($dato)));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $nombre = limpiar($_POST["nombre"] ?? "");
  $email = limpiar($_POST["email"] ?? "");
  $asunto = limpiar($_POST["asunto"] ?? "");
  $mensaje = limpiar($_POST["mensaje"] ?? "");

  // Validaciones básicas
  if (empty($nombre)) {
    $errores[] = "El nombre es obligatorio.";
  }

  if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errores[] = "El correo electrónico no es válido.";
  }

  if (empty($asunto)) {
    $errores[] = "Debés seleccionar un asunto.";
  }

  if (empty($mensaje)) {
    $errores[] = "El mensaje no puede estar vacío.";
  }

  // Si no hay errores, se muestra respuesta
  if (count($errores) === 0) {
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
      <meta charset='UTF-8'>
      <title>Mensaje Recibido</title>
      <link rel='stylesheet' href='estilo.css'>
    </head>
    <body>
      <main class='respuesta-formulario'>
        <h1>¡Gracias por contactarte, $nombre!</h1>
        <p>Recibimos tu mensaje sobre <strong>$asunto</strong>.</p>
        <p>Te responderemos pronto al correo <strong>$email</strong>.</p>
        <section class='mensaje-recibido'>
          <h2>Tu mensaje:</h2>
          <blockquote>$mensaje</blockquote>
        </section>
        <a href='main.html'>Volver</a>
      </main>
    </body>
    </html>";
  } else {
    // Mostrar errores
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
      <meta charset='UTF-8'>
      <title>Errores en el formulario</title>
      <link rel='stylesheet' href='estilo.css'>
    </head>
    <body>
      <main class='respuesta-formulario'>
        <h2>Ups... se encontraron errores:</h2>
        <ul>";
    foreach ($errores as $error) {
      echo "<li>$error</li>";
    }
    echo "</ul>
        <a href='javascript:history.back()'>Volver al formulario</a>
      </main>
    </body>
    </html>";
  }
} else {
  echo "Acceso no permitido.";
}
?>