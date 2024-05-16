<?php
session_start();
?>
<?php 
    include 'connect.php';
    $songid = $_GET['id'];
   
    // sql to delete a record
    $sql = "DELETE FROM tblplaylistsongs WHERE songid = $songid and ".$_SESSION['playlistid']." = playlistid";
    
    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);
        header("Location: playlistsongs.php?id=".$_SESSION['playlistid']); //If book.php is your main page where you list your all records
        exit;
    } else {
        echo "Error deleting record";
    }
?>