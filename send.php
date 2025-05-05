<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "contacto@dancarmar.com";  // Direcci車n de destino
    $subject = "Nuevo mensaje desde el formulario de contacto";  // Asunto del correo

    // Obtener y limpiar los datos del formulario
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["phone"]));
    $service = strip_tags(trim($_POST["service"]));
    $message = strip_tags(trim($_POST["message"]));

    // Composici車n del cuerpo del correo
    $email_content = "Nombre: $name\n";
    $email_content .= "Correo: $email\n";
    $email_content .= "Telefono: $phone\n";
    $email_content .= "Servicio: $service\n\n";
    $email_content .= "Mensaje:\n$message\n";

    // Cabecera del correo
    $headers = "From: $name <$email>";

    // Enviar el correo utilizando la funci車n mail() de PHP
    if (mail($to, $subject, $email_content, $headers)) {
        echo "<script>alert('Mensaje enviado correctamente'); window.location.href='https://www.dancarmar.com';</script>";
    } else {
        http_response_code(500);
        echo "<script>alert('Error al enviar el mensaje. Intenta m芍s tarde.'); window.location.href='https://www.dancarmar.com';</script>";
    }
} else {
    http_response_code(403);
    echo "<script>alert('Acceso prohibido.'); window.location.href='https://www.dancarmar.com';</script>";
}
?>
