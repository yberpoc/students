<?php

class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $connect;

    public function __construct($host, $db_name, $username, $password) {
        $this->host = $host;
        $this->db_name = $db_name;
        $this->username = $username;
        $this->password = $password;

        $this->getConnection();
    }

    private function getConnection() {
        $this->connect = mysqli_connect($this->host, $this->username, $this->password, $this->db_name);
        if(!$this->connect){
            die('Error connect to data base');
        }
        return $this->connect;
    }

    public function getQuery($query) {
        $this->query = mysqli_query($this->connect, $query);
        if(!$this->query) {
            printf(mysqli_error($this->connect));
        } else {
            return $this->query;
        }
    }
}

$db = new Database('localhost', '*******', '*******', '*******');








