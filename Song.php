<?php 
require_once __DIR__ . "/Database.php";

class Song extends Database {
    private $song_title;
    private $artist_id;
    private $genre_id;
    private $price;
    private $id;
        
	public function setTitle($title){
        $this->song_title=$title;
    }
    
    public function setArtistId($id){ 
        $this->artist_id = $id;
    }
    
    public function setGenreId($id){
        $this->genre_id = $id;
    }
    
    public function setPrice($pri){
        $this->price = $pri;
    }
    
    public function getTitle(){
        return $this->song_title;
    }
    
    public function save(){        
        $sql = "
                INSERT INTO songs(title, artist_id, genre_id, price)
                VALUES ('$this->song_title', '$this->artist_id', '$this->genre_id', '$this->price')
                ";

            $statement = static::$pdo->prepare($sql);
            $statement->execute();
            $this->id = static::$pdo->lastInsertID();
	}
    
    public function getId(){
        return $this->id;
        
    
    }
}

?>