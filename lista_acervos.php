<?php
require 'bd.php';
include 'acervo.php';

$bd = new BD();
$acervos = new Acervo($bd->database_connect());

if (is_set($_GET['query'])) {
    $acervos->set_titulo($_GET['query']);
    $acervos->set_autor($_GET['query']);
    $lista = $acervos->buscar_acervo_por_titulo_ou_autor();
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
                <h2>Acervos encontrados</h2>
                <table class="table table-stiped table-hover">
                    <thead>
                        <th>Autor</th>
                        <th>Titulo</th>
                        <th>Editora</th>
                        <th>Ano</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Ações</th>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_assoc($lista)) : ?>
                            <tr>
                                <td><?= $row['autor'] ?></td>
                                <td><?= $row['titulo'] ?></td>
                                <td><?= $row['nome_editora'] ?></td>
                                <td><?= $row['ano'] ?></td>
                                <td><?= $row['quantidade'] ?></td>
                                <td><?= $row['preco'] ?></td>
                                <td>
                                    <a href="./editar_acervo.php?id=<?= $row['id'] ?>">Editar</a> - 
                                    <a href="./excluir_acervo.php?id=<?= $row['id'] ?>">Apagar</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

<?php
}
else {
    echo 'Espera-se pelo menos um critério para busca';
}