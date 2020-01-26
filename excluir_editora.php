<?php
require 'bd.php';
include 'editora.php';

$bd = new BD();
$editoras = new Editora($bd->database_connect());

if (is_set($_GET['id'])) {
    $id = $_GET['id'];
    
    $editoras->set_id($id);

    if ($editoras->apagar_editora())
        header('location:index.php');
    else
        echo 'Falha ao excluir editora';
}