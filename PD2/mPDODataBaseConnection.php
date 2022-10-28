<?php

require_once 'mPDO.php';

class mPDODataBaseConnection {

    public function getLocalhostConnectionOnServer() {
        if (getenv('COMPUTERNAME') == "LAPTOP") {
            $host = 'Tommy2.heliohost.org';
        } else {
            $host = 'localhost';
        }
        $db = 'sitmalidi_db';
        $user = 'sitmalidi_admin';
        $pass = 'athina2004ELENA';
        $charset = 'utf8';



        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new mPDO($dsn, $user, $pass, $options);
            return $pdo;
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode();
        }
    }

    public function getLocalhostConnection() {
        if (getenv('COMPUTERNAME') == "LAPTOP") {
            $host = 'Tommy2.heliohost.org';
        } else {
            $host = 'localhost';
        }
        $db = 'sitmalidi_db';
        $user = 'sitmalidi_admin';
        $pass = 'athina2004ELENA';
        $charset = 'utf8';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        try {
            $pdo = new mPDO($dsn, $user, $pass, $options);
            return $pdo;
        } catch (\PDOException $e) {
            echo $e->getMessage() . " Error Code:";
            echo $e->getCode();
        }
    }

}
