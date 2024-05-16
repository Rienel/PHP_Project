<?php 
    include 'connect.php';
    $id = $_GET['id'];
    
    // sql to delete a record
    $sql = "DELETE FROM tblplaylist WHERE playlist = $id";
    
    if (mysqli_query($connection, $sql)) {
        mysqli_close($connection);
        header('Location: dashboard.php'); //If book.php is your main page where you list your all records
        exit;
    } else {
        echo "Error deleting record";
    }
?>