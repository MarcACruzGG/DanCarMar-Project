<?php
$message_status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "contacto@dancarmar.com";
    $subject = "Nuevo mensaje desde el formulario de contacto";

    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $message = strip_tags(trim($_POST["message"]));

    $email_content = "Nombre: $name\n";
    $email_content .= "Correo: $email\n";
    $email_content .= "Teléfono: $phone\n\n";
    $email_content .= "Mensaje:\n$message\n";

    $headers = "From: $name <$email>";

    if (mail($to, $subject, $email_content, $headers)) {
        $message_status = "Mensaje enviado correctamente.";
    } else {
        $message_status = "Error al enviar el mensaje. Intenta más tarde.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Contacto</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="name" placeholder="Nombre" required><br>
        <input type="email" name="email" placeholder="Correo electrónico" required><br>
        <input type="text" name="phone" placeholder="Teléfono"><br>
        <textarea name="message" placeholder="Tu mensaje" required></textarea><br>
        <button type="submit">Enviar</button>
    </form>

    <?php if (!empty($message_status)): ?>
    <script>
        alert("<?php echo $message_status; ?>");
    </script>
    <?php endif; ?>
</body>
</html>
