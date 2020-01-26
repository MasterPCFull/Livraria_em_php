<?php
require 'bd.php';
include 'acervo.php';

$bd = new BD();
$acervos = new Acervo($bd->database_connect());

if (is_set($_GET['id'])) {
    $id = $_GET['id'];
    
    $lista = $acervos->buscar_por_id($id);
    $acervo = $lista->fetch_assoc();

    $editoras_cadastro = $acervos->listar_acervos();
}

if (is_set($_POST['atualizacao_acervo'])) {

    $id = $_GET['id'];

    $acervos->set_id($id);
    $acervos->set_editora($_POST['editora']);
    $acervos->set_autor($_POST['autor']);
    $acervos->set_titulo($_POST['titulo']);
    $acervos->set_ano($_POST['ano']);
    $acervos->set_preco($_POST['preco']);
    $acervos->set_tipo($_POST['tipo']);
    $acervos->set_quantidade($_POST['quantidade']);

    if ($acervos->atualizar_acervo())
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
                    <h3>Editar Acervo</h3>
                    <form id="acervo_atualizacao">
                        <input id="acervo_atu_id" name="id" type="hidden" value="<?= $acervo['id'] ?>" />
                        <select class="form-control" name="editora" id="acervo_atu_editora">
                            <?= '<option class="bg-primary" value="'.$acervo['id'].'" selected >Selecionado: '.$acervo['nome_editora'].'</option>' ?>
                            <?php
                            while ($row = mysqli_fetch_assoc($editoras_cadastro)) {
                                echo '<option value="' . $row['id'] . '">' . $row['nome_editora'] . '</option>';
                            }
                            ?>
                        </select> <br/>
                        Autor: 
                        <input id="acervo_atu_autor" 
                            class="form-control" name="autor" type="text" 
                            value="<?= $acervo['autor'] ?>" /> <br/>
                        Título: 
                        <input id="acervo_atu_titulo" 
                            class="form-control" name="titulo" type="text" 
                            value="<?= $acervo['titulo'] ?>" /> <br/>
                        Ano: 
                        <input id="acervo_atu_ano" 
                            class="form-control" name="ano" type="date"
                            value="<?= $acervo['ano'] ?>" /> <br/>
                        Preço: 
                        <input id="acervo_atu_preco" 
                            class="form-control" name="preco" type="number" 
                            value="<?= $acervo['preco'] ?>" /> <br/>
                        Gênero: 
                        <select class="form-control" name="tipo" id="acervo_atu_tipo">
                            <?php
                                switch($acervo['tipo']) {
                                    case 1 :
                                        echo '<option class="bg-primary" value="'.$acervo['tipo'].'" selected >Selecionado: Ficção Científica</option>';
                                        break;
                                    case 2 :
                                        echo '<option value="'.$acervo['tipo'].'" selected >Auto Ajuda</option>';
                                        break;
                                    case 3 :
                                        echo '<option value="'.$acervo['tipo'].'" selected >Engenharia</option>';
                                        break;
                                    case 4 :
                                        echo '<option value="'.$acervo['tipo'].'" selected >Astrofísica</option>';
                                        break;
                                }
                            ?>
                            <option value="1">Ficção Científica</option>
                            <option value="2">Auto Ajuda</option>
                            <option value="3">Engenharia</option>
                            <option value="4">Astrofísica</option>
                        </select> <br />
                        Quantidade: 
                        <input id="acervo_atu_quantidade" class="form-control" name="quantidade" type="number"
                            value="<?= $acervo['quantidade'] ?>" /> <br/>
                        <input vale="Enviar" class="btn btn-outline-primary" type="submit" />  <br />
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