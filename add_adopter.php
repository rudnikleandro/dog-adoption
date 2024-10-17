<?php
include 'conn.php'; // Inclui a conexão com o banco de dados

// Buscar animais disponíveis
$sql_animals = "SELECT id, name FROM dogs WHERE deleted_at IS NULL";
$result_animals = $conn->query($sql_animals);

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $animal_id = $_POST['animal_id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $cpf = $_POST['cpf'];
    $adoption_date = $_POST['adoption_date'];

    // Verifica se o nome e a data da adoção foram preenchidos
    if (!empty($name) && !empty($adoption_date) && !empty($animal_id)) {
        $sql = "INSERT INTO adopters (animal_id, name, phone, cpf, adoption_date) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issss", $animal_id, $name, $phone, $cpf, $adoption_date);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Adotante cadastrado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao cadastrar adotante: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Nome, Animal e Data de Adoção são obrigatórios!</div>";
    }
}
?>

<h2>Cadastrar Adotante</h2>

<form action="admin_panel.php?page=add_adopter" method="POST">
    <div class="mb-3">
        <label for="animal_id" class="form-label">Selecione o Animal</label>
        <select class="form-select" id="animal_id" name="animal_id" required>
            <option value="">Escolha um animal</option>
            <?php while ($row = $result_animals->fetch_assoc()): ?>
                <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> (ID: <?php echo $row['id']; ?>)</option>
            <?php endwhile; ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="name" class="form-label">Nome do Adotante</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>

    <div class="mb-3">
        <label for="phone" class="form-label">Telefone</label>
        <input type="text" class="form-control" id="phone" name="phone">
    </div>

    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" class="form-control" id="cpf" name="cpf">
    </div>

    <div class="mb-3">
        <label for="adoption_date" class="form-label">Data da Adoção</label>
        <input type="date" class="form-control" id="adoption_date" name="adoption_date" required>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar Adotante</button>
</form>
