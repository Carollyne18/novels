<?php
// Novel.php - Novel model class
class Novel {
    private $conn;
    private $table_name = "novels";

    public $id;
    public $title;
    public $author;
    public $genre;
    public $publication_year;
    public $description;
    public $rating;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                 SET title=:title, author=:author, genre=:genre, 
                     publication_year=:publication_year, description=:description, 
                     rating=:rating, created_at=:created_at";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->publication_year = htmlspecialchars(strip_tags($this->publication_year));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->created_at = date('Y-m-d H:i:s');

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":publication_year", $this->publication_year);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":created_at", $this->created_at);

        return $stmt->execute();
    }

    public function readAll() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if($row) {
            $this->title = $row['title'];
            $this->author = $row['author'];
            $this->genre = $row['genre'];
            $this->publication_year = $row['publication_year'];
            $this->description = $row['description'];
            $this->rating = $row['rating'];
            $this->created_at = $row['created_at'];
            return true;
        }
        return false;
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                 SET title=:title, author=:author, genre=:genre, 
                     publication_year=:publication_year, description=:description, 
                     rating=:rating 
                 WHERE id=:id";

        $stmt = $this->conn->prepare($query);

        $this->title = htmlspecialchars(strip_tags($this->title));
        $this->author = htmlspecialchars(strip_tags($this->author));
        $this->genre = htmlspecialchars(strip_tags($this->genre));
        $this->publication_year = htmlspecialchars(strip_tags($this->publication_year));
        $this->description = htmlspecialchars(strip_tags($this->description));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":title", $this->title);
        $stmt->bindParam(":author", $this->author);
        $stmt->bindParam(":genre", $this->genre);
        $stmt->bindParam(":publication_year", $this->publication_year);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":id", $this->id);

        return $stmt->execute();
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}

