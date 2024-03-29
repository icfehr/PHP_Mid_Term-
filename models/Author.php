<?php
// File: config.php
class Author {
    private $conn;
    private $table = "authors";
    // Properties
    public $id;
    public $author;

    public function __construct($db){
        $this->conn = $db;
    }

    // Get authors
    public function read(){
        $query = 'SELECT * FROM ' . $this->table;
        // Prepared statement
        $stmt = $this->conn->prepare($query);
        // Execute
        $stmt->execute();
        return $stmt;
    }
    
    public function create(){
        $query = 'INSERT INTO ' . $this->table . ' SET author=:author';
        $stmt = $this->conn->prepare($query);
        $this->author = htmlspecialchars(strip_tags($this->author));
        $stmt->bindParam(':author', $this->author);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->errorInfo()[2]);
        return false;
    }
    
    // Single Read Function
    public function read_single(){
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id = ? LIMIT 0,1';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row && isset($row['id']) && isset($row['author'])) {
            $this->id = $row['id'];
            $this->author = $row['author'];
        } else {
            // Handle the case where no row was found
        }
    }
    
    
    // Update Function
    public function update(){
        $query = 'UPDATE ' . $this->table . ' SET author=:author WHERE id = :id';
        $stmt = $this->conn->prepare($query);
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':author', $this->author);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->errorInfo()[2]);
        return false;
    }

    // Delete Function
    public function delete(){
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';  
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->errorInfo()[2]);
        return false;
    }
}
