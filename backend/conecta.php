<?php

class Banco 

{

    const DB_HOST = "localhost";
    const DB_USER = "root";
    const DB_PASSWORD = "";
    const DB_DATABASE = "barbearia";

    function conectar(){
        $conn = new PDO("mysql:host=" . SELF::DB_HOST . ";dbname=" . SELF::DB_DATABASE . ";charset:utf8", SELF::DB_USER, SELF::DB_PASSWORD);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; 
    }
    function autentica($usuario){
        $conn = $this->conectar();
        $query = $conn->query('SELECT * FROM usuario WHERE administrador IS NOT NULL AND usuario_id = ' . $usuario);
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}