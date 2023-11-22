<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="VISTAS/CSS/estilos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="VISTAS/img/Logo.png">
    <title>MISELANEA Y PAPELERIA ENSUEÑO</title>
</head>
<body>
    <header>
        <a class="logo">Inicio Sesión</a>
        <input type="checkbox" id="menu-bar">
        <label for="menu-bar" class="fa fa-bars"></label>
    </header>
    <section class="formulario" id="formulario">
    <form action="CONTROLADORES/Login.php" method="POST" enctype="multipart/form-data">
    <h1 class="heading">Iniciar Sesión</h1>
    <div class="inputcaja">
        <input type="varchar" name="nombreUsuario" required="true">
        <label for="">Nombre Usuario<span class="required">*</span></label>
    </div>
    <div class="inputcaja">
        <input type="password" name="clave" id="passwordField" required>
        <label for="">Contraseña<span class="required">*</span></label>
        <span class="icon-container" onclick="togglePassword()">
            <i id="passwordToggleIcon" class="fas fa-eye"></i>
        </span>
    </div>
    <button type="submit" class="btn">Iniciar Sesión</button>
    <!-- Leyenda para campos obligatorios -->
    <p class="required-note">Los campos marcados con <span class="required">*</span> son obligatorios.</p>
    <?php
        session_start();
        if (isset($_SESSION['error_message'])) {
            $error_message = $_SESSION['error_message'];
            unset($_SESSION['error_message']); // Limpia el mensaje de error
            echo '<div class="error-message">' . $error_message . '</div>';
        }
    ?>
</form>
    </section>

    <script>
        function togglePassword() {
            var passwordField = document.getElementById("passwordField");
            var passwordToggleIcon = document.getElementById("passwordToggleIcon");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                passwordToggleIcon.className = "fas fa-eye-slash";
            } else {
                passwordField.type = "password";
                passwordToggleIcon.className = "fas fa-eye";
            }
        }
    </script>
</body>
</html>
