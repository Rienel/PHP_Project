<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div><h1>Edit Playlist</h1></div>
    <h2>Edit Playlist Name: </h1>
    <form method="post">
        <input type="text" placeholder="Playlist name" name="txtplaylistname">
        <button type="submit" name="btnSave">Save</button>
    </form>

    <?php
        include 'connect.php';
        $id = $_GET['id'];
                if(isset($_POST['btnSave'])){		
                    //retrieve data from form and save the value to a variable
                    //for tbluserprofile
                    $playlistname=$_POST['txtplaylistname'];
                    echo "<p>'Error deleting record'</p>";
                    
                    //save data to tbluserprofile			
                    $sql1 ="UPDATE tblplaylist
                            SET playlistname = '$playlistname'
                            WHERE playlistid = '$id'";
                    if (mysqli_query($connection, $sql1)) {
                        mysqli_close($connection);
                        echo "<p>'Error deleting record'</p>";
                        header('Location: dashboard.php'); //If book.php is your main page where you list your all records
                        exit;
                    } else {
                        echo "Error deleting record";
                    }
                    
                }    

            ?>
</body>
</html>