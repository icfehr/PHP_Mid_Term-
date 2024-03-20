<?php
// File: config.php

class Database {
    private $host;
    private $database_name;
    private $username;
    private $password;

    
    public function __construct(){
        $this->host = getenv('DB_HOST');
        $this->database_name = getenv('Database');
        $this->username = getenv('DB_USERNAME');
        $this->password = getenv('DB__PASSWORD');
    }
    
    
    
    public $conn;

    public function connect(){
        $this-> conn = null;

        try {
            $this -> conn = new PDO("pgsql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);

            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $sql_quotes = "CREATE TABLE IF NOT EXISTS quotes (
                id INT AUTO_INCREMENT PRIMARY KEY,
                quote TEXT NOT NULL,
                author_id INT NOT NULL,
                category_id INT NOT NULL
            )";
        
            // Create the "authors" table
            $sql_authors = "CREATE TABLE IF NOT EXISTS authors (
                id INT AUTO_INCREMENT PRIMARY KEY,
                author VARCHAR(256) NOT NULL
            )";
        
            // Create the "categories" table
            $sql_categories = "CREATE TABLE IF NOT EXISTS categories (
                id INT AUTO_INCREMENT PRIMARY KEY,
                category VARCHAR(256) NOT NULL
            )";
        
        $this->conn->exec($sql_quotes);
        $this->conn->exec($sql_authors);
        $this->conn->exec($sql_categories);
    
        echo "Tables created";


        }catch(PDOException $e){
            echo "Connection Error: " . $e->getMessage();
        }
    
        return $this->conn;
    }
}



