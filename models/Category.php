<?php
// File: config.php
class Category {
    private $conn;
    private $table = "categories";
    //properties
    public  $id;
    public $category;

    public function __construct($db){
        $this->conn = $db;

    }

    //get posts
    public function read(){
        $query = ' SELECT
        c.category as category_name,
        c.id
        FROM
            ' . $this->table . ' c ORDER BY c.id DESC ';
            
        // Prepared
        $stmt =$this->conn-> prepare($query);
        // EXECUTE
        $stmt ->execute();
        return $stmt;
    }    

    public function create(){
        $query = ' INSERT INTO ' . $this->table . ' SET category=:category, id=:id';
        $stmt = $this->conn->prepare($query);
        $this->category = htmlspecialchars(strip_tags($this->category));
        $stmt->bindParam(':category', $this->category);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
    }

    public function read_single(){
        $query = ' SELECT * FROM categories WHERE id = ? LIMIT 0,1 ';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            extract($row);
            $this->id = $id;
            $this->category = $category;
        }
    }

    public function update(){
        $query = ' UPDATE ' . $this->table . ' SET category=:category WHERE id = :id ';
        $stmt = $this->conn->prepare($query);
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':category', $this->category);
        $stmt->bindParam(':id', $this->id);
        if($stmt->execute()){
            return true;
        }
        printf("Error: %s.\n", $stmt->error);
        return false;
        }
    
    public function delete(){
        $query = ' DELETE FROM ' . $this->table . ' WHERE id = :id ';
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
