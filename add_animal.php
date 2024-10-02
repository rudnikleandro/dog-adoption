<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
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

    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (isset($_FILES['image'])) {
        $check = getimagesize($_FILES['image']['tmp_name']);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "Arquivo não é uma imagem válida.";
            $uploadOk = 0;
        }
    }

    if ($_FILES['image']['size'] > 2000000) {
        echo "Desculpe, o arquivo é muito grande.";
        $uploadOk = 0;
    }

    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "Desculpe, apenas arquivos JPG, JPEG e PNG são permitidos.";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
            $sql = "INSERT INTO dogs (name, age, gender, breed, size, weight, veterinary_info, temperament, additional_info, location_id, image) 
                    VALUES ('$name', '$age', '$gender', '$breed', '$size', '$weight', '$veterinary_info', '$temperament', '$additional_info', '$location_id', '$image')";

            if ($conn->query($sql) === TRUE) {
                echo "<div class='alert alert-success'>Animal cadastrado com sucesso!</div>";
            } else {
                echo "<div class='alert alert-danger'>Erro ao cadastrar o animal: " . $conn->error . "</div>";
            }
        } else {
            echo "Desculpe, houve um erro ao fazer o upload da imagem.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo - Cadastro de Animais</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2>Cadastrar Novo Animal</h2>

        <form action="adddata.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Idade</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>

            <div class="mb-3">
                <label for="gender" class="form-label">Gênero</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="Macho">Macho</option>
                    <option value="Fêmea">Fêmea</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="breed" class="form-label">Raça</label>
                <input type="text" class="form-control" id="breed" name="breed" required>
            </div>

            <div class="mb-3">
                <label for="size" class="form-label">Tamanho</label>
                <select class="form-select" id="size" name="size" required>
                    <option value="Pequeno">Pequeno</option>
                    <option value="Médio">Médio</option>
                    <option value="Grande">Grande</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="weight" class="form-label">Peso (kg)</label>
                <input type="number" step="0.01" class="form-control" id="weight" name="weight" required>
            </div>

            <div class="mb-3">
                <label for="veterinary_info" class="form-label">Informações Veterinárias</label>
                <textarea class="form-control" id="veterinary_info" name="veterinary_info" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="temperament" class="form-label">Temperamento</label>
                <textarea class="form-control" id="temperament" name="temperament" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label for="additional_info" class="form-label">Informações Adicionais</label>
                <textarea class="form-control" id="additional_info" name="additional_info" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label for="location_id" class="form-label">ID da Localização</label>
                <input type="text" class="form-control" id="location_id" name="location_id" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Imagem do Animal</label>
                <input type="file" class="form-control" id="image" name="image" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Cadastrar Animal</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
