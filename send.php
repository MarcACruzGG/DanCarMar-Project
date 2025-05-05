<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Receptor del correo
    $to = "contacto@dancarmar.com";
    $subject = "Nuevo mensaje desde el formulario de contacto";

    // Sanitización de entradas
    $name = strip_tags(trim($_POST["name"] ?? ''));
    $email = filter_var(trim($_POST["email"] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"] ?? ''));
    $service = strip_tags(trim($_POST["service"] ?? ''));
    $message = strip_tags(trim($_POST["message"] ?? ''));

    // Validación básica
    if (empty($name) || empty($email) || empty($phone) || empty($service)) {
        http_response_code(400);
        echo "Por favor completa todos los campos requeridos.";
        exit;
    }

    // Contenido del correo
    $email_content = "Nombre: $name\n";
    $email_content .= "Correo: $email\n";
    $email_content .= "Teléfono: $phone\n";
    $email_content .= "Servicio: $service\n\n";
    $email_content .= "Mensaje:\n$message\n";

    // Cabeceras
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Envío
    if (mail($to, $subject, $email_content, $headers)) {
        echo "¡Mensaje enviado correctamente!";
    } else {
        http_response_code(500);
        echo "Error al enviar el mensaje. Intenta más tarde.";
    }
} else {
    http_response_code(403);
    echo "Acceso prohibido.";
}
?>
