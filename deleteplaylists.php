<?php 
    include 'connect.php';
    $id = $_GET['id'];
    
    $stmt = $connection->prepare("UPDATE tblplaylist SET isRemoved = 1 WHERE playlistid = ?");
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        $stmt->close();
        $connection->close();
        header('Location: dashboard.php'); 
        exit;
    } else {
        echo "Error updating record";
    }
?>
