<?php
include 'conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$sql = "SELECT * FROM dogs WHERE deleted_at IS NULL"; 
$result = $conn->query($sql);

?>

<h2>Animais Cadastrados</h2>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Idade</th>
            <th>Raça</th>
            <th>Abrigo</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['breed']; ?></td>
                    <td><?php echo $row['location_id']; ?></td>
                    <td>
                        <a href="admin_panel.php?page=edit_animal&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                        <a href="admin_panel.php?page=delete_animal&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir este animal?');">Deletar</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">Nenhum animal cadastrado.</td>
            </tr>
            <?php endif;?>
    </tbody>
</table>