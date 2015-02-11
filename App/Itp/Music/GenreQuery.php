<?php 

namespace Itp\Music;

use \PDO;

class GenreQuery extends \Itp\Base\Database {
	public function getAll(){
        		  $sql = "
                SELECT *
                FROM genres
                ORDER BY genre
                ";

            $statement = static::$pdo->prepare($sql);
            $statement->execute();
            return $statement->fetchAll(PDO::FETCH_OBJ);

	}
    
    }

?>