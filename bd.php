<?php

class BD {
    
    private $host;
    private $user;
    private $pass;
    private $data;
     
    public function database_connect() {

        $this->host = 'localhost';
        $this->user = 'root';
        $this->pass = '';
        $this->data = 'banco_acervo';
        
        $conn = mysqli_connect($this->host, $this->user, $this->pass, $this->data);

        if ($conn)
            return $conn;
        return false;
    }
}