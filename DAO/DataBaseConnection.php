<?php

class DataBaseConnection {

    private $db;
    private $user;
    private $pass;

    function __construct() {
        // $this->db = 'h0u4Z7iqi8';
        //  $this->user = 'h0u4Z7iqi8';
        //  $this->pass = 'Z5dTwqvCQd';

        
        $this->db = 'sitmalidi_db';
        $this->user = 'sitmalidi_ admin';
        $this->pass = 'athina2004ELENA';
        
        $this->db = 'pet4u_db';
        $this->user = 'root';
        $this->pass = 'athina2004';
        
    }

    public function getConnection() {
        // $host = 'remotemysql.com';

        $host = 'localhost:3306';
        $db = $this->db;
        $user = $this->user;
        $pass = $this->pass;
        $charset = 'utf8';



        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int) $e->getCode());
        }

        return $pdo;
    }

}
