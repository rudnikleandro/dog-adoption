<?php include 'conn.php'; ?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Focinho Farejador</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded">
      <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11" aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
          <a class="navbar-brand col-lg-3 me-0" href="#">Focinhos.com</a>
          <ul class="navbar-nav col-lg-6 justify-content-lg-center">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Animais</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false">Menu</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">Item 1</a></li>
                <li><a class="dropdown-item" href="#">Item 2</a></li>
                <li><a class="dropdown-item" href="#">Item 3</a></li>
              </ul>
            </li>
          </ul>
          <div class="d-lg-flex col-lg-3 justify-content-lg-end">
            <a href="login.php"><button class="btn btn-primary">Acesso Restrito</button></a>
          </div>
        </div>
      </div>
    </nav>
  </header>

  <div class="container col-xxl-8 px-4 py-5">
    <div class="row flex-lg-row-reverse align-items-center g-5 py-5">
      <div class="col-10 col-sm-8 col-lg-6">
        <img src="fotos-cachorros.jpg" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="700" height="500" loading="lazy">
      </div>
      <div class="col-lg-6">
        <h1 class="display-5 fw-bold text-body-emphasis lh-1 mb-3">Focinhosssssssss</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam bibendum tortor vitae magna posuere, vitae commodo mi convallis.</p>
        <div class="d-grid gap-2 d-md-flex justify-content-md-start">
          <button type="button" class="btn btn-primary btn-lg px-4 me-md-2">Buscar</button>
          <button type="button" class="btn btn-outline-secondary btn-lg px-4">Cadastrar</button>
        </div>
      </div>
    </div>
  </div>

  <section style="margin: 50px 0;">
    <div class="container">
      <div class="row">
        <?php
        require_once "conn.php";
        $sql_query = "SELECT * FROM dogs";
        if ($result = $conn->query($sql_query)) {
          while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $name = $row['name'];
            $age = $row['age'];
            $gender = $row['gender'];
            $breed = $row['breed'];
            $size = $row['size'];
            $weight = $row['weight'];
            $veterinary_info = $row['veterinary_info'];
            $temperament = $row['temperament'];
            $additional_info = $row['additional_info'];
            $location_id = $row['location_id'];
            $created_at = $row['created_at'];
            $image = $row['image'];
        ?>

        <div class="col-md-4">
          <div class="card mb-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#dogModal<?php echo $id; ?>">
            <img src="uploads/<?php echo $image; ?>" class="card-img-top" alt="<?php echo $name; ?>" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title"><?php echo $name; ?></h5>
              <p class="card-text">Idade: <?php echo $age; ?> anos</p>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="dogModal<?php echo $id; ?>" tabindex="-1" aria-labelledby="dogModalLabel<?php echo $id; ?>" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="dogModalLabel<?php echo $id; ?>"><?php echo $name; ?></h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p><strong>Idade:</strong> <?php echo $age; ?> anos</p>
                  <p><strong>Gênero:</strong> <?php echo $gender; ?></p>
                  <p><strong>Raça:</strong> <?php echo $breed; ?></p>
                  <p><strong>Tamanho:</strong> <?php echo $size; ?></p>
                  <p><strong>Peso:</strong> <?php echo $weight; ?> kg</p>
                  <p><strong>Informações Veterinárias:</strong> <?php echo $veterinary_info; ?></p>
                  <p><strong>Temperamento:</strong> <?php echo $temperament; ?></p>
                  <p><strong>Informações Adicionais:</strong> <?php echo $additional_info; ?></p>
                  <p><strong>Localização:</strong> <?php echo $location_id; ?></p>
                  <p><strong>Criado em:</strong> <?php echo $created_at; ?></p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <button type="button" class="btn btn-primary">Adotar</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <?php
          }
        }
        ?>
      </div>
    </div>
  </section>

</body>

</html>
