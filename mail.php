<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Configura os detalhes do email
    $to = "arthur.miura@gmail.com"; // Substitua pelo seu email de destino
    $subject = "Formulário de Contato - $subject";

    // Constrói o corpo do email
    $body = "Nome: $name\n";
    $body .= "Email: $email\n";
    $body .= "Mensagem:\n$message\n";

    // Envia o email
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
    mail($to, $subject, $body, $headers);

    // Redireciona o usuário para uma página de confirmação
    header("Location: obrigado.php");
    exit;
}
?>