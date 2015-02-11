<?php     require_once __DIR__ . "/vendor/autoload.php";

use Itp\Music\GenreQuery;
use Itp\Music\ArtistQuery;
use Itp\Music\Song;
use Symfony\Component\HttpFoundation\Session\Session;

$session = new Session();
$session->start();

    if (isset($_POST['submit'])) :

		$song = new Song();
        if(!$_POST['song_title']){
            header('Location: add-song.php');
        }
        $song->setTitle($_POST['song_title']);
        $song->setArtistId($_POST['artist_id']);
        $song->setGenreId($_POST['genre_id']);
        $song->setPrice($_POST['price']);
        $song->save();

        $mess = 'The song '. $song->getTitle().
            'with an ID of '. $song->getId(). ' was inserted successfully!';

        $session->getFlashBag()->add('song-success', $mess);


        header('Location: add-song.php');
        exit;
        
        endif; ?>

<!DOCTYPE html>
        <html>
        <link href="css/bootstrap.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
        </head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <title>Add Song</title>
    
<head>
    <body>

        Add your song:

    <?php foreach ($session->getFlashBag()->get('song-success') as $message) : ?>
            <p><?php echo $message ?></p>
    <?php endforeach; ?>

<?php

    $artists = (new ArtistQuery())->getAll();
    $genres = (new GenreQuery())->getAll();
?>
    
    <div class="container">
    <form  method="post">
        <div class="form-group">
        <label for="song_title"> Song Title: </label>
            <input type="text" name="song_title" class="form-control">
        </div>
        <div class="form-group">
            <label for="artist_id"> Artists: </label>
            <select id="artist_id" name="artist_id" class="form-control">
                <?php foreach ($artists as $artist) : ?>
                    <option value = "<?php echo $artist->id;?>">
                        <?php echo $artist->artist_name;?></option>
                <?php endforeach; ?>
            </select>
        </div>   
        <div class="form-group">
        <label for="genre_id"> Genre: </label>
            <select id=genre_id name="genre_id" class="form-control">
               <?php foreach ($genres as $genre) : ?>
                    <option value = "<?php echo $genre->id;?>">
                        <?php echo $genre->genre;?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
        <label for="prive"> Price: </label>
            <input type="text" name="price" class="form-control">
        </div>
            <input type = "submit" name = "submit" value = "Add Song!"> </input>
    </form>
       
    </div>
 


</body>

</html>