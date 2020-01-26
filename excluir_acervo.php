<?php
require 'bd.php';
include 'acervo.php';

$bd = new BD();
$acervos = new Acervo($bd->database_connect());

if (is_set($_GET['id'])) {
    $id = $_GET['id'];
    
    $acervos->set_id($id);

    if ($acervos->apagar_acervo())
        header('location:index.php');
    else
        echo 'Falha ao excluir acervo';
}