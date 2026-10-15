    <?php
    // Establecer los datos de conexión
    $servername = "localhost:3306"; // Cambia esto si tu servidor MySQL está en un puerto diferente
    $username = "root"; // Cambia esto si tu nombre de usuario de MySQL es diferente
    $password = ""; // Cambia esto si tienes una contraseña configurada para tu usuario de MySQL
    $dbname = "banco_senati";

    // Crear una nueva conexión a la base de datos
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    /* comprobar la conexión */
    if ($mysqli->connect_errno) {
        printf("Falló la conexión: %s\n", $mysqli->connect_error);
        exit();
    }
    ?>
