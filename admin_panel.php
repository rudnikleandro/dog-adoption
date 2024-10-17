<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta chartset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Painel de Administração</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>

    <body>
    <div class="sidebar">
        <h2 class="text-white text-center">Painel Admin</h2>
        <a href="admin_panel.php?page=dashboard"><i class="fas fa-home"></i> Início</a>
        <a href="admin_panel.php?page=add_animal"><i class="fas fa-plus-circle"></i> Cadastrar Animal</a>
        <a href="admin_panel.php?page=list_animals"><i class="fas fa-paw"></i> Listar Animais</a>
        <a href="admin_panel.php?page=report_adoptions"><i class="fas fa-chart-line"></i> Relatório de Adoções</a>
        <a href="admin_panel.php?page=change_password"><i class="fas fa-key"></i> Mudar Senha</a>
        <a href="logout.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
    </div>

        <div class="content">
            <?php
            switch ($page) {
                case 'add_animal':
                    include 'add_animal.php';
                    break;
                case 'list_animals':
                    include 'list_animals.php';
                    break;
                case 'edit_animal':
                    include 'edit_animal.php';
                    break;
                case 'report_adoptions':
                    include 'report_adoptions.php';
                    break;
                case 'change_password':
                    include 'change_password.php';
                    break;
                default:
                    echo "<h1>Bem vindo ao Painel Administrativo!</h1><p>Escola uma das opções ao lado.</p>";
                    break;
            }
            ?>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    </body>

</html>