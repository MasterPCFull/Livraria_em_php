<?php

class Acervo { 

   private $bd;
   private $id;
   private $editora;
   private $autor;
   private $titulo;
   private $ano;
   private $preco;
   private $tipo;
   private $quantidade;
   private $bd_name;

   public function __construct($bd) {
      $this->bd = $bd;
      $this->bd_name = 'acervo';
   }

   public function set_id($value) { $this->id = $value; }

   public function set_editora($value) { $this->editora = $value; }

   public function set_autor($value) { $this->autor = $value; }

   public function set_titulo($value) { $this->titulo = $value; }

   public function set_ano($value) { $this->ano = $value; }

   public function set_preco($value) { $this->preco = $value; }

   public function set_tipo($value) { $this->tipo = $value; }
   
   public function set_quantidade($value) { $this->quantidade = $value; }

   public function cadastrar_acervo() {
      $sql="INSERT INTO acervo (titulo, autor, ano, preco, quantidade, tipo, id_editora) VALUES ('$this->titulo', '$this->autor', '$this->ano', '$this->preco', '$this->quantidade', '$this->tipo', '$this->editora');";

      if( $this->bd->query($sql))
         return true;
      return false;
   }

   public function listar_acervos() {
      $sql = "SELECT a.*, e.nome as nome_editora FROM $this->bd_name a INNER JOIN editora e ON a.id_editora = e.id;";
      $lista = $this->bd->query($sql);
      if($lista)
         return $lista;
      return false;
   }

   public function buscar_por_id($id) {
      $sql = "
         SELECT a.*, e.nome as nome_editora 
         FROM $this->bd_name a 
         INNER JOIN editora e ON a.id_editora = e.id
         WHERE a.id = $id LIMIT 1;"
      ;
      $lista = $this->bd->query($sql);
      if($lista)
         return $lista;
      return false;
   }

   public function atualizar_acervo() {
      $sql="
         UPDATE acervo 
         SET 
            titulo = '$this->titulo', 
            autor = '$this->autor', 
            ano = '$this->ano', 
            preco = '$this->preco', 
            quantidade = '$this->quantidade', 
            tipo = '$this->tipo', 
            id_editora = '$this->editora'
         WHERE
            id = '$this->id'
      ";

      if( $this->bd->query($sql))
         return true;
      return false;
   }

   public function apagar_acervo() {
      $sql = 
         "DELETE FROM acervo 
         WHERE
            id = '$this->id';"
      ;

      if( $this->bd->query($sql))
         return true;
      return false;
  }

  public function buscar_acervo_por_titulo_ou_autor() {
   $sql = 
      "SELECT *
      FROM $this->bd_name
      WHERE titulo LIKE '%$this->titulo%' OR autor LIKE '%$this->autor%';"
   ;        
   $lista = $this->bd->query($sql);
   if(count($lista) > 0)
      return $lista;
   return false;
  }
}