<?php
require 'bd.php';
include 'editora.php';

$bd = new BD();
$editoras = new Editora($bd->database_connect());

if (is_set($_GET['query'])) {
    $editoras->set_nome($_GET['query']);
    $lista = $editoras->buscar_editora_por_nome();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Portifólio</title>

        <link rel="stylesheet" 
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="assets/css/main.css">
    </head>
    <body>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <h2>Editoras encontradas</h2>
                    <table class="table table-stiped table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>                            
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($lista)) : ?>
                                <tr>
                                    <td><?= $row['nome'] ?></td>
                                    <td>
                                        <a href="./editar_editora.php?id=<?= $row['id'] ?>">Editar</a> - 
                                        <a href="./excluir_editora.php?id=<?= $row['id'] ?>">Apagar</a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
</html>

<?php
}
else {
    echo 'Espera-se pelo menos um critério para busca';
}