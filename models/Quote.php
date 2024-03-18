<?php
// File: config.php
class Quote{
    private $conn;
    private $table = "Quote";

    //properties
    public  $id;
    public $quote;
    public $author_id;
    public $category_id;

    public function __construct($db){
        $this->conn = $db;

    }

    //get posts
    public function read(){
        $query = ' SELECT * FROM quotes ';
            
    // Prepared
        $stmt =$this->conn->prepare($query);
    // EXECUTE
        $stmt ->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function create(){
        $query = ' INSERT INTO quotes SET quote=:quote, author_id=:author_id, category_id=:category_id ';
        $stmt = $this->conn->prepare($query);
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function read_single(){
        $query = ' SELECT * FROM quotes WHERE id = ? LIMIT 0,1 ';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
        $this->id = $id;
        $this->quote = $quote;
        $this->author_id = $author_id;
        $this->category_id = $category_id;
    }

    public function update(){
        $query = ' UPDATE quotes SET quote=:quote, author_id=:author_id, category_id=:category_id WHERE id = :id ';
        $stmt = $this->conn->prepare($query);
        $this->quote = htmlspecialchars(strip_tags($this->quote));
        $this->author_id = htmlspecialchars(strip_tags($this->author_id));
        $this->category_id = htmlspecialchars(strip_tags($this->category_id));
        $this->id = htmlspecialchars(strip_tags($this->id)); 
        $stmt->bindParam(':quote', $this->quote);
        $stmt->bindParam(':author_id', $this->author_id);
        $stmt->bindParam(':category_id', $this->category_id);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function delete(){
        $query = "DELETE FROM quotes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }
}