<?php

    require_once "conn.php";

    if (isset($_POST['submit'])) {

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

        if (!empty($name) && !empty($age) && !empty($gender)) {
            $sql = "INSERT INTO dogs (name, age, gender, breed, size, weight, veterinary_info, temperament, additional_info, location_id) 
                    VALUES ('$name', '$age', '$gender', '$breed', '$size', '$weight', '$veterinary_info', '$temperament', '$additional_info', '$location_id')";

            if (mysqli_query($conn, $sql)) {
                header("Location: admin_panel.php");
                exit();
            } else {
                echo "Erro ao inserir os dados: " . mysqli_error($conn);
            }
        } else {
            echo "Os campos Nome, Idade e Gênero são obrigatórios!";
        }
    } else {
        echo "Formulário não foi submetido.";
    }
?>
