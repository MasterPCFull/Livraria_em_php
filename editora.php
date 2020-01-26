<?php

class editora { 

    private $bd;
    private $id;
    private $nome;
    private $bd_name;
    
    public function __construct($bd) {
        $this->bd = $bd;
        $this->bd_name = 'editora';
    }

    public function set_id($value) { $this->id = $value; }

    public function set_nome($value) { $this->nome = $value; }

    public function cadastrar_editora() {
        $sql="INSERT INTO editora(nome) VALUES ('$this->nome');";

        if( $this->bd->query($sql))
            return true;
        return false;
    }

    public function listar_editoras() {
        $sql = "SELECT * FROM editora;";
        $lista = $this->bd->query($sql);
        if($lista)
            return $lista;
        return false;
    }

    public function buscar_por_id($id) {
        $sql = 
            "SELECT *
            FROM $this->bd_name
            WHERE id = $id LIMIT 1;"
        ;
        $lista = $this->bd->query($sql);
        if($lista)
           return $lista;
        return false;
     }

    public function atualizar_editora() {
        $sql = 
            "UPDATE editora 
            SET 
                nome = '$this->nome'
            WHERE
                id = '$this->id';
        ";
  
        if( $this->bd->query($sql))
           return true;
        return false;
    }

    public function apagar_editora() {
        $sql = 
            "DELETE FROM editora 
            WHERE
                id = '$this->id';"
        ;
  
        if( $this->bd->query($sql))
           return true;
        return false;
    }

    public function buscar_editora_por_nome() {
        $sql = 
            "SELECT *
            FROM $this->bd_name
            WHERE nome LIKE '%$this->nome%';"
        ;        
        $lista = $this->bd->query($sql);
        if(count($lista) > 0)
           return $lista;
        return false;
    }
}