<?php
// Inclui o arquivo de cabeçalho da página
require "../includes/header.php";

// Inclui o arquivo de configuração do sistema
require "../config/config.php";

// Verifica se o método de requisição é GET e se o arquivo atual é o mesmo que está sendo solicitado
// Se for verdadeiro, retorna um erro 403 e redireciona o usuário para a página inicial do site
if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])) {
    header('HTTP/1.0 403 Forbidden', TRUE, 403);
    die(header('location: ' . APPURL));
}

// Verifica se o botão "delete" foi clicado
if (isset($_POST['delete'])) {
    // Obtém o ID do item a ser removido da lista de desejos
    $id = $_POST['id'];

    // Prepara a consulta SQL para remover o item da lista de desejos
    $delete = $conn->prepare("DELETE FROM wishlist WHERE id='$id'");

    // Executa a consulta SQL
    $delete->execute();
}

// Verifica se o usuário não está logado no sistema
// Se não estiver, redireciona o usuário para a página inicial do site
if (!isset($_SESSION['username'])) {
    header("location: " . APPURL);
}

// Inclui o arquivo de rodapé da página
require "../config/footer.php";
