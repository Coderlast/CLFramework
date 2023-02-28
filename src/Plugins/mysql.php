<?php

class mysql{
    public $conDB;
    protected $connection;

    function __construct($dbs, $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false,])
    {
            $host = $dbs['host'];
            $dbname = $dbs['dbname'];
            $user = $dbs['user'];
            $pass = $dbs['user'];
            $charset = $dbs['charset']; 
            $this->conDB = TRUE;
            try {
                $this->connection = new PDO("mysql:host=$host;dbname=$dbname;charset=$charset", $user, $pass, $options);
            } catch (PDOException $e) {
                throw new PDOException($e->getMessage(), (int)$e->getCode());
            }
    }

    public function DisConnect()
    {
        $this->connection = NULL;
        $this->conDB = FALSE;
    }

    public function query($query)
    {
        try {
            $stmt = $this->connection->prepare($query);
            return $stmt->execute();

        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function onerow($query, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function row($query, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            $stmt->execute($params);
            return $stmt->fetchAll(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function query_cruid($query, $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            return $stmt->execute($params);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage());
        }
    }

    public function count($table_name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM " . $table_name);
            $stmt->execute();
            return $stmt->rowCount();
        } catch (PDOException $e) {
            throw new Exception($e->getMessage());
        }
    }
}