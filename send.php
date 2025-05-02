<?php
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
        $status = "Mensaje enviado correctamente.";
    } else {
        $status = "Error al enviar el mensaje. Intenta más tarde.";
    }

    // Redirige de vuelta a index.html con el mensaje
    header("Location: index.html?status=" . urlencode($status));
    exit;
} else {
    http_response_code(403);
    echo "Acceso prohibido.";
}
