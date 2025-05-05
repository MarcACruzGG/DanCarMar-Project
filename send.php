<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "contacto@dancarmar.com";
    $subject = "Nuevo mensaje desde el formulario de contacto";

    // Recoger y limpiar los datos del formulario
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $service = strip_tags(trim($_POST["service"]));
    $message = strip_tags(trim($_POST["message"]));

    // Contenido del correo electrónico
    $email_content = "Nombre: $name\n";
    $email_content .= "Correo: $email\n";
    $email_content .= "Teléfono: $phone\n";
    $email_content .= "Servicio: $service\n\n";
    $email_content .= "Mensaje:\n$message\n";

    // Cabecera del correo
    $headers = "From: $name <$email>";
    $headers .= "\r\nReply-To: $email";
    $headers .= "\r\nContent-Type: text/plain; charset=UTF-8";

    // Enviar el correo
    if (mail($to, $subject, $email_content, $headers)) {
        // Redireccionar al mismo formulario con un mensaje de éxito
        header("Location: {$_SERVER['HTTP_REFERER']}?status=success");
        exit();
    } else {
        // Redireccionar al mismo formulario con un mensaje de error
        header("Location: {$_SERVER['HTTP_REFERER']}?status=error");
        exit();
    }
} else {
    // Si no es una petición POST
    http_response_code(403);
    echo "Acceso prohibido.";
}
