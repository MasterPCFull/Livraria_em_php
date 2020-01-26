<?php
require 'bd.php';
include 'acervo.php';
include 'editora.php';

$bd = new BD();
$acervo = new Acervo($bd->database_connect());
$editora = new Editora($bd->database_connect());

if ($_POST['cadastro_acervo']) {
    
    $acervo->set_editora($_POST['editora']);
    $acervo->set_autor($_POST['autor']);
    $acervo->set_titulo($_POST['titulo']);
    $acervo->set_ano($_POST['ano']);
    $acervo->set_preco($_POST['preco']);
    $acervo->set_tipo($_POST['tipo']);
    $acervo->set_quantidade($_POST['quantidade']);

    if ($acervo->cadastrar_acervo())
        echo 'Acervo cadastrado com sucesso!';
    else
        echo 'Falha ao cadastrar acervo!';
}

if ($_POST['cadastro_editora']) {
    
    $editora->set_nome($_POST['nome']);

    if ($editora->cadastrar_editora())
        echo 'Acervo cadastrado com sucesso!';
    else
        echo 'Falha ao cadastrar acervo!';
}

$acervos = $acervo->listar_acervos();
$editoras_cadastro = $editora->listar_editoras();
$editoras_tabela = $editora->listar_editoras();
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
                <div class="col-sm-10">
                    <div class="jumbotron">
                        <h3>Sistema de Cadastro</h3>
                        <h5>Cadestre seu livro aqui.</h5>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-5">                    
                    <h3>Buscar Editora</h3>                    
                    <form id="editora_busca" action="./lista_editoras.php" method="get">
                        <input type="text" name="query" class="form-control" placeholder="Que editora você procura" autofocus /> <br/>
                        <input type="submit" vale="Procurar" /> <br/>
                    </form>
                </div>

                <div class="col-sm-5">
                    <h3>Buscar Acervo</h3>
                    <form id="acervo_busca" action="./lista_acervos.php" method="get">
                        <input type="text" name="query" class="form-control" placeholder="Que titulo você procura" autofocus /> <br/>
                        <input type="submit" vale="Procurar" /> <br/>
                    </form>
                </div>
            </div>
            <br /><br />
            <div class="row justify-content-center">
                <div class="col-sm-5">
                    <h3>Cadastrar Acervo</h3>
                    <form id="acervo_cadastro">
                        <select class="form-control" name="editora" id="acervo_cad_editora">
                            <option value="0" selected disabled>Escolha uma Editora</option>
                            <?php
                            while ($row = mysqli_fetch_assoc($editoras_cadastro)) {
                                echo '<option value="' . $row['id'] . '">' . $row['nome'] . '</option>';
                            }
                            ?>
                        </select> <br/>
                        <input id="acervo_cad_autor" class="form-control" name="autor" type="text" placeholder="Autor" autofocus /> <br/>
                        <input id="acervo_cad_titulo" class="form-control" name="titulo" type="text" placeholder="Título" /> <br/>
                        <input id="acervo_cad_ano" class="form-control" name="ano" type="date" /><br/>
                        <input id="acervo_cad_preco" class="form-control" name="preco" type="number" placeholder="R$00,00" /> <br/>
                        <select class="form-control" name="tipo" id="acervo_cad_tipo">
                            <option value="0" selected disabled>Escolha um tipo</option>
                            <option value="1">Ficção Científica</option>
                            <option value="2">Auto Ajuda</option>
                            <option value="3">Engenharia</option>
                            <option value="4">Astrofísica</option>
                        </select> <br />
                        <input id="acervo_cad_quantidade" class="form-control" name="quantidade" type="number" placeholder="0" /> <br />
                        <input vale="Enviar" class="btn btn-outline-primary" type="submit" />  <br />
                    </form>
                </div>

                <div class="col-sm-5">
                    <h3>Cadastrar Editora</h3>
                    <form id="editora_cadastro">
                        <input id="editora_cad_editora" class="form-control" placeholder="Nome da editora ..." name="editora" type="name" /> <br/>
                        <input vale="Enviar" class="btn btn-outline-primary" type="submit" />
                    </form>                        
                </div>
            </div>

            <br /><br />
            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <h2>Acervos cadastrados</h2>
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
                            <?php while ($row = mysqli_fetch_assoc($acervos)) : ?>
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

            <div class="row justify-content-center">
                <div class="col-sm-8">
                    <h2>Editoras cadastradas</h2>
                    <table class="table table-stiped table-hover">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>                            
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($editoras_tabela)) : ?>
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

        <script src="assets/js/jquery.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" 
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" 
            crossorigin="anonymous"></script>
        <script src="assets/js/main.js"></script> 
    </body>
</html>