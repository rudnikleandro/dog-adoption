<?php

include 'conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'];
if (!isset($id)) {
    echo "Animal não encontrado";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $breed = $_POST['breed'];
    $size = $_POST['size'];
    $weight = $_POST['weight'];
    $veterinary_info = $_POST['veterinary_info'];
    $temperament = $_POST['temperament'];
    $additional_info = $_POST['additional_info'];
    $location_id = $_POST['location_id'];

    $sql = "UPDATE dogs SET
    name='$name', 
    age='$age', 
    gender='$gender', 
    breed='$breed',
    size='$size', 
    weight='$weight', 
    veterinary_info='$veterinary_info',
    temperament='$temperament', 
    additional_info='$additional_info', 
    location_id='$location_id'
    WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'> Animal atualizado com sucesso!</div>";
    } else {
        echo "<div class='alert alert-danger'>Erro ao atualizar o animal: " . $conn->error . "</div>";
    }
} else {
    $sql = "SELECT * FROM dogs WHERE id = $id";
    $result = $conn->query($sql);
    $animal = $result->fetch_assoc();
}

?>

<h2>Editar Animal</h2>

<form action="admin_panel.php?page=edit_animal&id=<?php echo $id; ?>" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Nome</label>
        <input type="text" class="form-control" id="name" name="name" value="<?php echo $animal['name']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="age" class="form-label">Idade</label>
        <input type="number" class="form-control" id="age" name="age" value="<?php echo $animal['age']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="gender" class="form-label">Gênero</label>
        <select class="form-select" id="gender" name="gender" required>
            <option value="Macho" <?php if ($animal['gender'] == 'Macho') echo 'selected'; ?>>Macho</option>
            <option value="Fêmea" <?php if ($animal['gender'] == 'Fêmea') echo 'selected'; ?>>Fêmea</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="breed" class="form-label">Raça</label>
        <input type="text" class="form-control" id="breed" name="breed" value="<?php echo $animal['breed']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="size" class="form-label">Tamanho</label>
        <select class="form-select" id="size" name="size" required>
            <option value="Pequeno" <?php if ($animal['size'] == 'Pequeno') echo 'selected'; ?>>Pequeno</option>
            <option value="Médio" <?php if ($animal['size'] == 'Médio') echo 'selected'; ?>>Médio</option>
            <option value="Grande" <?php if ($animal['size'] == 'Grande') echo 'selected'; ?>>Grande</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="weight" class="form-label">Peso (kg)</label>
        <input type="number" class="form-control" id="weight" name="weight" value="<?php echo $animal['weight']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="veterinary_info" class="form-label">Informações Veterinárias</label>
        <textarea class="form-control" id="veterinary_info" name="veterinary_info" rows="3" required><?php echo $animal['veterinary_info']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="temperament" class="form-label">Temperamento</label>
        <textarea class="form-control" id="temperament" name="temperament" rows="3" required><?php echo $animal['temperament']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="additional_info" class="form-label">Informações Adicionais</label>
        <textarea class="form-control" id="additional_info" name="additional_info" rows="3"><?php echo $animal['additional_info']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="location_id" class="form-label">ID da Localização</label>
        <input type="text" class="form-control" id="location_id" name="location_id" value="<?php echo $animal['location_id']; ?>" required>
    </div>

    <button type="submit" class="btn btn-primary">Salvar Alterações</button>
</form>