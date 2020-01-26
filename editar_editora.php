<?php
require 'bd.php';
include 'editora.php';

$bd = new BD();
$editoras = new Editora($bd->database_connect());

if (is_set($_GET['id'])) {
    $id = $_GET['id'];
    
    $lista = $editoras->buscar_por_id($id);
    $editora = $lista->fetch_assoc();
}

if (is_set($_POST['atualizacao_editora'])) {

    $id = $_GET['id'];

    $editoras->set_id($id);
    $editoras->set_nome($_POST['nome']);

    if ($editoras->atualizar_editora())
        echo 'Acervo atualizado com sucesso!';
    else
        echo 'Falha ao atualizar acervo!';
}

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
                <div class="col-sm-5">
                <h3>Atualizar Editora</h3>
                    <form id="editora_atualizacao">
                        <input id="editora_atu_id" name="id" type="hidden" value="<?= $editora['id'] ?>" />
                        Editora: 
                        <input id="editora_atu_nome" class="form-control" 
                            value="<?= $editora['nome'] ?>" name="editora" type="text" /> <br/>
                        <input vale="Atualizar" class="btn btn-outline-primary" type="submit" />
                    </form>
                </div>
            </div>
        </div>

        <script src="assets/js/jquery.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
            crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script> 
    </body>
</html>